@if(Auth::check())
  <a href="{{ route('dashboard') }}">
    <img src="{{ asset('default-profile.png') }}" class="h-10 rounded-full" alt="Profile" />
  </a>
@else
  <a href="{{ route('login.form') }}" class="text-red-600">Login</a>
  <a href="{{ route('register.form') }}" class="ml-4 text-red-600">Register</a>
@endif