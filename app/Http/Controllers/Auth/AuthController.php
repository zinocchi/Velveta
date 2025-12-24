<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/'
            ],
        ], [
            'name.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
            'password.regex' => 'Password harus mengandung minimal satu huruf besar, satu angka, dan satu simbol.',
        ]);

        $user = User::create([
            'fullname' => $validatedData['fullname'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($user, true);

        return redirect()->intended('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt('google_' . $googleUser->getId()),
            ]);

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'login' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    //     $credentials = [
    //         $loginType => $credentials['login'],
    //         'password' => $credentials['password'],
    //     ];

    //     if (Auth::attempt($credentials, $request->filled('remember'))) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/');
    //     }

    //     return back()->withErrors([
    //         'email' => 'Email atau password salah.',
    //     ])->onlyInput('email');
    // }

    public function login(Request $request)
{
    $request->validate([
        'login' => 'required',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->login)
        ->orWhere('username', $request->login)
        ->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    $token = $user->createToken('coffee-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Berhasil logout.');
    }
}
