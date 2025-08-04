<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'username' => ['required', 'string', 'max:20', 'unique:users', 'regex:/^[a-zA-Z0-9_]+$/'],
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
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, dan underscore (_).',
            'password.regex' => 'Password harus mengandung minimal satu huruf besar, satu angka, dan satu simbol.',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => e($data['name']),
            'username' => e($data['username']),
            'email' => e($data['email']),
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(\Illuminate\Http\Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('status', 'Verifikasi email telah dikirim. Silakan cek email Anda.');
    }
}