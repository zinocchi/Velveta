<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'work_pin' => 'required|unique:users,work_pin',
        ]);

        $admin = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'work_pin' => $request->work_pin,
            'role' => 'admin',
        ]);

        return response()->json([
            'message' => 'Admin registered successfully',
            'data' => $admin
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'work_pin' => 'required|string',
        ]);

        $admin = User::where('fullname', $request->fullname)
            ->where('work_pin', $request->work_pin)
            ->where('role', 'admin')
            ->first();

        if (!$admin) {
            return response()->json([
                'message' => 'Invalid admin credentials'
            ], 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'user' => [
                'id' => $admin->id,
                'fullname' => $admin->fullname,
                'role' => $admin->role,
            ]
        ]);
    }
}
