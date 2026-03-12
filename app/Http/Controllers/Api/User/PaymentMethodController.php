<?php
// app/Http/Controllers/Api/PaymentMethodController.php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\EWalletProvider;
use App\Models\Bank;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Get all active payment methods
     */
    public function getMethods()
    {
        try {
            $methods = PaymentMethod::where('is_active', true)
                ->orderBy('display_order')
                ->get()
                ->map(function ($method) {
                    // Decode settings
                    $method->settings = is_string($method->settings)
                        ? json_decode($method->settings)
                        : $method->settings;

                    // Add providers for e-wallet
                    if ($method->code === 'e_wallet') {
                        $method->providers = EWalletProvider::where('is_active', true)
                            ->orderBy('display_order')
                            ->get()
                            ->map(function ($provider) {
                                $provider->settings = is_string($provider->settings)
                                    ? json_decode($provider->settings)
                                    : $provider->settings;
                                return $provider;
                            });
                    }

                    // Add banks for bank transfer
                    if ($method->code === 'bank_transfer') {
                        $method->banks = Bank::where('is_active', true)
                            ->orderBy('display_order')
                            ->get()
                            ->map(function ($bank) {
                                $bank->settings = is_string($bank->settings)
                                    ? json_decode($bank->settings)
                                    : $bank->settings;
                                $bank->accounts = is_string($bank->accounts)
                                    ? json_decode($bank->accounts)
                                    : $bank->accounts;
                                return $bank;
                            });
                    }

                    return $method;
                });

            return response()->json([
                'success' => true,
                'message' => 'Payment methods retrieved successfully',
                'data' => $methods
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payment methods',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validate payment details before processing
     */
    public function validatePayment(Request $request)
    {
        try {
            $request->validate([
                'method' => 'required|string|in:credit_card,e_wallet,bank_transfer,cash',
                'details' => 'required|array'
            ]);

            $method = PaymentMethod::where('code', $request->method)
                ->where('is_active', true)
                ->first();

            if (!$method) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or inactive payment method'
                ], 400);
            }

            // Validate based on method
            switch ($request->method) {
                case 'credit_card':
                    $request->validate([
                        'details.card_number' => 'required|string|min:16|max:19',
                        'details.card_holder' => 'required|string|max:255',
                        'details.expiry' => 'required|string|regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/',
                        'details.cvv' => 'required|string|size:3'
                    ]);

                    // Simple Luhn algorithm check
                    $cardNumber = str_replace(' ', '', $request->details['card_number']);
                    if (!$this->validateLuhn($cardNumber)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid card number'
                        ], 400);
                    }
                    break;

                case 'e_wallet':
                    $request->validate([
                        'details.provider' => 'required|string|in:OVO,GoPay,DANA',
                        'details.phone' => 'required|string|regex:/^08[0-9]{8,11}$/'
                    ]);

                    // Check if provider exists and is active
                    $provider = EWalletProvider::where('code', strtolower($request->details['provider']))
                        ->where('is_active', true)
                        ->first();

                    if (!$provider) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid or inactive e-wallet provider'
                        ], 400);
                    }
                    break;

                case 'bank_transfer':
                    $request->validate([
                        'details.bank' => 'required|string|in:BCA,Mandiri,BNI,BRI'
                    ]);

                    $bank = Bank::where('code', strtolower($request->details['bank']))
                        ->where('is_active', true)
                        ->first();

                    if (!$bank) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid or inactive bank'
                        ], 400);
                    }
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment details validated successfully',
                'data' => [
                    'method' => $request->method,
                    'valid' => true
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simple Luhn algorithm for card validation
     */
    private function validateLuhn($number)
    {
        $sum = 0;
        $alt = false;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $n = $number[$i];
            if ($alt) {
                $n *= 2;
                if ($n > 9) {
                    $n = ($n % 10) + 1;
                }
            }
            $sum += $n;
            $alt = !$alt;
        }
        return ($sum % 10 == 0);
    }

    /**
     * Get single payment method by code
     */
    public function getMethod($code)
    {
        try {
            $method = PaymentMethod::where('code', $code)
                ->where('is_active', true)
                ->first();

            if (!$method) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment method not found'
                ], 404);
            }

            // Decode settings
            $method->settings = is_string($method->settings)
                ? json_decode($method->settings)
                : $method->settings;

            // Load related data
            if ($method->code === 'e_wallet') {
                $method->providers = EWalletProvider::where('is_active', true)
                    ->orderBy('display_order')
                    ->get();
            }

            if ($method->code === 'bank_transfer') {
                $method->banks = Bank::where('is_active', true)
                    ->orderBy('display_order')
                    ->get();
            }

            return response()->json([
                'success' => true,
                'data' => $method
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payment method'
            ], 500);
        }
    }
}
