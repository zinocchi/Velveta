<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Ambil input login (bisa email atau username)
        $login = $request->input('login');
        $password = $request->input('password');

        // Tentukan apakah user login p akai email atau username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba login
        if (!Auth::attempt([$field => $login, 'password' => $password])) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Ambil user yang sudah tervalidasi
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // Bikin token sanctum
        $token = $user->createToken('velvetaToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'fullname' => $validated['fullname'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // cek user berdasarkan email
        $user = User::where('email', $googleUser->email)->first();

        // kalau belum ada, register otomatis
        if (!$user) {
            $user = User::create([
                'fullname' => $googleUser->name ?? $googleUser->nickname,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(uniqid()), // random password
                'photo' => $googleUser->avatar, // kalau mau simpan foto
            ]);
        }

        // bikin token sanctum
        $token = $user->createToken('velvetaToken')->plainTextToken;

        // redirect ke frontend react
        return redirect("http://localhost:5173/auth/callback?token=$token&user=" . urlencode(json_encode($user)));
    }
}
