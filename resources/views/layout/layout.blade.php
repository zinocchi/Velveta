<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Velveta - Premium Coffee Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: white;
            color: #1f2937;
        }

        .logo-img {
            transition: all 0.3s ease;
        }

        .logo-img:hover {
            transform: rotate(15deg);
        }

        .menu-item {
            position: relative;
        }

        .menu-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #9B111E;
            transition: width 0.3s ease;
        }

        .menu-item:hover::after {
            width: 100%;
        }

        .hero-btn {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2) translateY(-3px);
        }

        .footer-link {
            position: relative;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #4b5563;
            transition: width 0.3s ease;
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Fix untuk dropdown dan button */
        #profileMenu a,
        #profileMenu button {
            cursor: pointer !important;
            pointer-events: auto !important;
        }

        #profileMenu {
            z-index: 9999 !important;
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <header class="fixed top-0 w-full bg-white shadow-md z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-8">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('velveta.png') }}" alt="Velveta Logo"
                                class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover transition-transform duration-300 hover:rotate-12">
                        </a>
                    </div>
                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ route('menu') }}"
                            class="menu-item text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Menu</a>
                        <a href="{{ route('about') }}"
                            class="menu-item text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">About
                            Us</a>
                        <a href="{{ route('reward') }}"
                            class="menu-item text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Reward</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="https://www.google.com/maps" target="_blank"
                        class="hidden md:flex items-center text-gray-700 hover:text-red-700 transition-colors duration-300 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Find a store
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 border border-gray-800 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors duration-300">Sign
                            in</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition-colors duration-300">Join
                            now</a>
                    @endguest

                    @auth
                        <div class="relative" id="profileDropdown">
                            <button onclick="toggleProfileMenu()"
                                class="flex items-center space-x-2 cursor-pointer focus:outline-none">
                                @php
                                    $user = Auth::user();
                                    $userPhoto = $user->photo ?? null;
                                    $userName = $user->name ?? 'User';
                                    $userInitial = strtoupper(substr($userName, 0, 1));
                                @endphp

                                @if ($userPhoto)
                                    <img src="{{ Storage::disk('public')->url($userPhoto) }}" alt="Profile Picture"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-700 flex items-center justify-center text-white font-semibold">
                                        {{ $userInitial }}
                                    </div>
                                @endif
                                <span class="text-gray-900 font-medium hidden md:inline-block">
                                    {{ $userName }}
                                </span>
                            </button>
                            <div id="profileMenu"
                                class="absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-xl py-2 w-48 hidden z-50">
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-user-edit mr-2"></i>Edit Profile
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>

                                <!-- LOGOUT FIXED -->
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 transition-colors duration-200 cursor-pointer">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Login Success Alert -->
    @if (session('login_success'))
        <div id="loginSuccessAlert"
            class="fixed top-24 right-4 bg-red-700 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-1000 opacity-100">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Login Berhasil!
            </div>
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('loginSuccessAlert');
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 1000);
                }
            }, 3000);
        </script>
    @endif

    <!-- Logout Form (Hidden) -->
    @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    @endauth

    <script>
        // Function untuk toggle profile menu
        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        // Close profile menu when clicking outside
        document.addEventListener('click', function(event) {
            const profileDropdown = document.getElementById('profileDropdown');
            const profileMenu = document.getElementById('profileMenu');

            if (profileDropdown && profileMenu && !profileDropdown.contains(event.target)) {
                profileMenu.classList.add('hidden');
            }
        });

        // Close profile menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const profileMenu = document.getElementById('profileMenu');
                if (profileMenu) {
                    profileMenu.classList.add('hidden');
                }
            }
        });

        // Scroll reveal animations
        if (typeof ScrollReveal !== 'undefined') {
            ScrollReveal().reveal('.animate-fade-in', {
                duration: 1000,
                origin: 'bottom',
                distance: '50px',
                easing: 'ease-in-out',
                interval: 200
            });
        }

        // Additional fix untuk memastikan semua element bisa diklik
        document.addEventListener('DOMContentLoaded', function() {
            // Force pointer events untuk semua element di dropdown
            const profileMenu = document.getElementById('profileMenu');
            if (profileMenu) {
                const allElements = profileMenu.querySelectorAll('*');
                allElements.forEach(element => {
                    element.style.pointerEvents = 'auto';
                });
            }
        });
    </script>
</body>

</html>
