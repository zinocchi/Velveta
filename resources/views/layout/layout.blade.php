<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Velveta - Premium Coffee Experience</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://unpkg.com/scrollreveal"></script>
  <style>
    body {
      font-family: 'Lato', sans-serif;
      @apply bg-white text-gray-900;
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
      @apply bg-red-700;
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
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
      @apply bg-gray-600;
      transition: width 0.3s ease;
    }
    
    .footer-link:hover::after {
      width: 100%;
    }
    
    .floating {
      animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
  </style>
</head>
<body class="overflow-x-hidden">
  <header class="fixed top-0 w-full bg-white shadow-md z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex items-center space-x-8">
          <div class="logo">
            <img src="velveta.png" alt="Velveta Logo" class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover transition-transform duration-300 hover:rotate-12">
          </div>
          <nav class="hidden md:flex space-x-8">
            <a href="{{ route('menu') }}" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Menu</a>
            <a href="{{ route ('about') }}" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">About Us</a>
            <a href="{{ route ('reward') }}" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Reward</a>
          </nav>
        </div>
        <div class="flex items-center space-x-4">
          <a href="https://www.google.com/maps" class="hidden md:flex items-center text-gray-700 hover:text-red-700 transition-colors duration-300 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Find a store
          </a>
          @guest
          <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-800 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors duration-300">Sign in</a>
          <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition-colors duration-300">Join now</a>
          @endguest
          @if (session('login_success'))
          <div id="loginSuccesAlert" class="fixed top-4 right-4 bg-red-700 text-white px-4 py-2 rounded shadow-mdz-50 transition-opacity duration-1000 opacity-100">
        Login Berhasil"
          </div>
          @endif

         <div class="relative" id="profileDropdown">
    <button onclick="toggleProfileMenu()" class="flex items-center space-x-2 cursor-pointer">
        @if(Auth::check())
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->photo)}}" alt="Profile Picture" class="w-10 h-10 rounded-full object-cover">
            @else
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
            <span class="text-gray-900 font hidden md:inline-block">
                {{ Auth::user()->name }}
            </span>
        @endif
    </button>
    <div id="profileMenu" class="absolute right-0 mt-2 bg-white border rounded-lg shadow-lg py-2 w-40 hidden z-50">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    function toggleProfileMenu() {
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        const profileDropdown = document.getElementById('profileDropdown');
        const profileMenu = document.getElementById('profileMenu');
        
        if (!profileDropdown.contains(event.target)) {
            profileMenu.classList.add('hidden');
        }
    });
</script>
      </div>
    </div>
  </header>