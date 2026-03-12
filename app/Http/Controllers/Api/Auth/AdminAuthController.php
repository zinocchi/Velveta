<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\AdminWorkPin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'work_pin' => 'required|string|size:9',
        ]);

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
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'work_pin' => 'required|string|size:9',
        ]);

        $workPin = $request->input('work_pin');

        if (!preg_match('/^VELVETA\d{2}$/', $workPin)) {
            return response()->json([
                'success' => false,
                'message' => 'Work PIN format wrong.'
            ], 422);
        }

        $pinNumber = (int) substr($workPin, -2);

        $existingPin = AdminWorkPin::where('work_pin', $workPin)->first();
        if ($existingPin && $existingPin->is_used) {
            return response()->json([
                'success' => false,
                'message' => 'This work PIN has already been used.'
            ], 422);
        }

        $lastPin = AdminWorkPin::where('is_used', true)
            ->orderBy('id', 'desc')
            ->first();

        $expectedNumber = $lastPin ? ((int) substr($lastPin->work_pin, -2)) + 1 : 1;

        $expectedPin = 'VELVETA' . str_pad($expectedNumber, 2, '0', STR_PAD_LEFT);

        if ($workPin !== $expectedPin) {
            return response()->json([
                'success' => false,
                'message' => "Invalid work PIN sequence. Expected: {$expectedPin}",
                'expected_pin' => $expectedPin
            ], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'work_pin' => Hash::make($workPin),
            'role' => 'admin',
        ]);

        AdminWorkPin::updateOrCreate(
            ['work_pin' => $workPin],
            [
                'user_id' => $user->id,
                'is_used' => true,
                'used_at' => now()
            ]
        );

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
            'message' => 'Admin registered successfully',
            'next_pin' => 'VELVETA' . str_pad($expectedNumber + 1, 2, '0', STR_PAD_LEFT)
        ], 201);
    }

    /**
     * Cek status login attempts
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
