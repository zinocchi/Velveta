<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Velveta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .bg-velveta {
            background-color: #9B111E;
        }

        .hover-bg-velveta-dark:hover {
            background-color: #7a0e19;
        }

        .text-velveta {
            color: #9B111E;
        }

        .focus-border-velveta:focus {
            border-color: #9B111E;
        }

        .focus-ring-velveta:focus {
            --tw-ring-color: rgba(155, 17, 30, 0.2);
        }

        .border-velveta {
            border-color: #9B111E;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <header
        class="fixed top-0 left-0 w-full bg-white text-black py-3 px-6 shadow-md z-50 flex justify-between items-center">
        <div class="logo">
            <img src="{{ asset('velveta.png') }}" alt="Logo" class="h-14">
        </div>
        <div class="nav-right flex gap-6 items-center">
        </div>
    </header>

    <main class="pt-32 pb-16 px-5 flex justify-center">
        <div class="w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-center mb-10 montserrat text-gray-800">Create Your Account</h2>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <p class="text-sm text-gray-500 mb-8">* indicates required field</p>

                @if ($errors->any())
                    <div class="text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="pb-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-6 text-gray-700 montserrat">Personal Information</h3>

                        <div>
                            <label for="name" class="block text-sm font-medium mb-2 text-gray-700">* Full
                                Name</label>
                            <input type="text" id="fullname" name="fullname" required value="{{ old('fullname') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                                placeholder="Enter your full name" />
                        </div>

                        <div class="mt-5">
                            <label for="email" class="block text-sm font-medium mb-2 text-gray-700">* Email
                                Address</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                                placeholder="Enter your email address" />
                        </div>
                    </div>

                    <div class="pt-2 pb-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-6 text-gray-700 montserrat">Account Information</h3>

                        <div>
                            <label for="username" class="block text-sm font-medium mb-2 text-gray-700">*
                                Username</label>
                            <input type="text" id="username" name="username" required value="{{ old('username') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                                placeholder="Choose a username" />
                            <p class="text-xs text-gray-500 mt-1">Username must be 4-20 characters</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
                            <div>
                                <label for="password" class="block text-sm font-medium mb-2 text-gray-700">*
                                    Password</label>
                                <div class="relative">
                                    <input type="password" required id="password" name="password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                                        placeholder="Create a password" />
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium mb-2 text-gray-700">* Confirm Password</label>
                                <div class="relative">
                                    <input type="password" required id="password_confirmation"
                                        name="password_confirmation" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                                        placeholder="Confirm your password" />
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Password must be at least 8 characters long and include at
                            least one uppercase letter, one lowercase letter, and one number.</p>
                    </div>

                    <div class="pt-2">
                        <h3 class="text-lg font-semibold mb-6 text-gray-700 montserrat">Preferences</h3>

                        <div class="flex items-start mb-4">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="newsletter" name="newsletter"
                                    class="w-5 h-5 text-velveta rounded focus:ring-red-300 border-gray-300"
                                    {{ old('newsletter', true) ? 'checked' : '' }} />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="newsletter" class="text-gray-700">Subscribe to our newsletter</label>
                                <p class="text-gray-500">Get updates on new products, special offers, and more.</p>
                            </div>
                        </div>

                        <div class="flex items-start mt-6">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="terms" name="terms"
                                    class="w-5 h-5 text-velveta rounded focus:ring-red-300 border-gray-300" required />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-700">I agree to the <a href="#"
                                        class="text-velveta hover:underline">Terms of Service</a> and <a href="#"
                                        class="text-velveta hover:underline">Privacy Policy</a></label>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('auth.redirect') }}"
                        class="flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg w-full transition">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#EA4335"
                                d="M24 9.5c3.5 0 6.3 1.5 8.2 2.8l6-6C34.9 2.7 29.8 0 24 0 14.7 0 6.7 5.4 2.8 13.2l7 5.5C11.7 13.2 17.3 9.5 24 9.5z" />
                            <path fill="#34A853"
                                d="M46.1 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.5c-.5 2.9-2.1 5.3-4.4 7l6.8 5.3C43.7 37.3 46.1 31.3 46.1 24.5z" />
                            <path fill="#4A90E2"
                                d="M24 48c6.5 0 11.9-2.1 15.9-5.7l-6.8-5.3C30.6 38.2 27.5 39.5 24 39.5c-6.6 0-12.2-4.4-14.3-10.3l-7 5.5C6.8 42.7 14.7 48 24 48z" />
                        </svg>
                        <span>Login with Google</span>
                    </a>


                    <div class="pt-8 flex justify-end space-x-4">
                        <a href="login"
                            class="px-6 py-3 bg-white text-velveta font-medium rounded-full shadow-sm border border-velveta hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transition duration-300">
                            Back to Login
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-velveta text-white font-medium rounded-full shadow-md hover-bg-velveta-dark focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transition duration-300 text-base">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-8">
                <p class="text-gray-600">Already have an account?
                    <a href="login" class="text-velveta font-medium hover:text-red-800 transition duration-200">Sign
                        in here</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="text-center text-gray-500 text-sm pb-8">
        <p>© {{ date('Y') }} Velveta. All rights reserved.</p>
    </footer>
</body>

</html>
