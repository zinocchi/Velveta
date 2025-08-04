<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 5;
    protected $decayMinutes = 1;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        
        // Cek apakah input berupa email atau username
        $field = filter_var($credentials[$this->username()], FILTER_VALIDATE_EMAIL) 
            ? 'email' 
            : 'username';
            
        return Auth::attempt([$field => $credentials[$this->username()], 'password' => $credentials['password']], $request->filled('remember'));
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ])->errorBag('default')->redirectTo(route('login'));
    }

    public function username()
    {
        return 'login';
    }
}