<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AdminWorkPin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'work_pin' => 'required|string|size:9',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $workPin = $request->input('work_pin');

        $ip = $request->ip();
        $cacheKey = "admin_login_attempts_{$ip}";
        $attempts = Cache::get($cacheKey, 0);

        if ($attempts >= 3) {
            $blockedUntil = Cache::get("admin_login_blocked_{$ip}");

            if ($blockedUntil && Carbon::parse($blockedUntil)->isFuture()) {
                $minutesLeft = Carbon::now()->diffInMinutes($blockedUntil);
                return response()->json([
                    'success' => false,
                    'message' => "Too many failed attempts. Please try again in {$minutesLeft} minutes.",
                    'blocked' => true,
                    'blocked_until' => $blockedUntil
                ], 429);
            }

            Cache::forget($cacheKey);
            $attempts = 0;
        }

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            $attempts++;
            Cache::put($cacheKey, $attempts, now()->addDay());

            if ($attempts >= 3) {
                $blockedUntil = now()->addDay();
                Cache::put("admin_login_blocked_{$ip}", $blockedUntil, now()->addDay());

                return response()->json([
                    'success' => false,
                    'message' => 'Too many failed attempts. You are blocked for 24 hours.',
                    'blocked' => true,
                    'blocked_until' => $blockedUntil
                ], 429);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'attempts_left' => 3 - $attempts
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. This account is not an admin.'
            ], 403);
        }

        if (!$user->work_pin || !Hash::check($workPin, $user->work_pin)) {
            $attempts++;
            Cache::put($cacheKey, $attempts, now()->addDay());

            if ($attempts >= 3) {
                $blockedUntil = now()->addDay();
                Cache::put("admin_login_blocked_{$ip}", $blockedUntil, now()->addDay());

                return response()->json([
                    'success' => false,
                    'message' => 'Too many failed attempts. You are blocked for 24 hours.',
                    'blocked' => true,
                    'blocked_until' => $blockedUntil
                ], 429);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid work PIN',
                'attempts_left' => 3 - $attempts
            ], 401);
        }

        Cache::forget($cacheKey);
        Cache::forget("admin_login_blocked_{$ip}");

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user'  => $user,
            'message' => 'Admin login successful'
        ]);
    }

    /**
     * Register a new admin user
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'work_pin' => 'required|string|size:9',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $workPin = strtoupper($request->input('work_pin'));

        // Check PIN format
        if (!preg_match('/^VELVETA\d{2}$/', $workPin)) {
            return response()->json([
                'success' => false,
                'message' => 'Work PIN format wrong. Must be VELVETA followed by 2 digits (e.g., VELVETA01).',
                'errors' => [
                    'work_pin' => ['Invalid PIN format. Must be VELVETA followed by 2 digits.']
                ]
            ], 422);
        }

        // Check if PIN is already used
        $existingPin = AdminWorkPin::where('work_pin', $workPin)->first();
        if ($existingPin && $existingPin->is_used) {
            return response()->json([
                'success' => false,
                'message' => 'This work PIN has already been used.',
                'errors' => [
                    'work_pin' => ['This work PIN has already been used. Please use the next available PIN.']
                ]
            ], 422);
        }

        // Get the last used PIN and determine expected next PIN
        $lastPin = AdminWorkPin::where('is_used', true)
            ->orderBy('id', 'desc')
            ->first();

        $expectedNumber = $lastPin ? ((int) substr($lastPin->work_pin, -2)) + 1 : 1;
        $expectedPin = 'VELVETA' . str_pad((string)$expectedNumber, 2, '0', STR_PAD_LEFT);

        // Check PIN sequence
        if ($workPin !== $expectedPin) {
            return response()->json([
                'success' => false,
                'message' => "Invalid work PIN sequence. Expected: {$expectedPin}",
                'expected_pin' => $expectedPin,
                'errors' => [
                    'work_pin' => ["Invalid PIN sequence. Please use {$expectedPin}"]
                ]
            ], 422);
        }

        // Create user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'work_pin' => Hash::make($workPin),
            'role' => 'admin',
        ]);

        // Update or create admin work PIN record
        AdminWorkPin::updateOrCreate(
            ['work_pin' => $workPin],
            [
                'user_id' => $user->id,
                'is_used' => true,
                'used_at' => now()
            ]
        );

        // Generate token
        $token = $user->createToken('admin-token')->plainTextToken;

        // Calculate next available PIN
        $nextPin = 'VELVETA' . str_pad((string)($expectedNumber + 1), 2, '0', STR_PAD_LEFT);

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
            'message' => 'Admin registered successfully',
            'next_pin' => $nextPin
        ], 201);
    }

    /**
     * Get available work PINs
     */
    public function availablePins()
    {
        // Get all used PINs
        $usedPins = AdminWorkPin::where('is_used', true)
            ->orderBy('id', 'asc')
            ->pluck('work_pin')
            ->toArray();

        // Get all PINs from database
        $allPins = AdminWorkPin::orderBy('work_pin', 'asc')
            ->get(['work_pin', 'is_used', 'user_id'])
            ->map(function($pin) {
                return [
                    'work_pin' => $pin->work_pin,
                    'is_used' => $pin->is_used,
                    'user_id' => $pin->user_id
                ];
            });

        // Find the next expected PIN
        $lastUsedPin = AdminWorkPin::where('is_used', true)
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastUsedPin ? ((int) substr($lastUsedPin->work_pin, -2)) + 1 : 1;
        $nextPin = 'VELVETA' . str_pad((string)$nextNumber, 2, '0', STR_PAD_LEFT);

        // Get available (unused) PINs
        $availablePins = AdminWorkPin::where('is_used', false)
            ->orderBy('work_pin', 'asc')
            ->get(['work_pin'])
            ->map(function($pin) {
                return ['work_pin' => $pin->work_pin];
            });

        return response()->json([
            'success' => true,
            'available_pins' => $availablePins,
            'all_pins' => $allPins,
            'next_pin' => $nextPin,
            'used_pins' => $usedPins
        ]);
    }

    /**
     * Check login attempts status
     */
    public function checkLoginStatus(Request $request)
    {
        $ip = $request->ip();
        $attempts = Cache::get("admin_login_attempts_{$ip}", 0);
        $blockedUntil = Cache::get("admin_login_blocked_{$ip}");

        return response()->json([
            'success' => true,
            'attempts' => $attempts,
            'attempts_left' => max(0, 3 - $attempts),
            'is_blocked' => !is_null($blockedUntil) && Carbon::parse($blockedUntil)->isFuture(),
            'blocked_until' => $blockedUntil
        ]);
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
