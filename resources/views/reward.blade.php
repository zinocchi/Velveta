<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velveta Rewards</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
    }
    .reward-card {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .reward-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .progress-bar {
      transition: width 1.5s ease-in-out;
    }
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .fade-in.show {
      opacity: 1;
      transform: translateY(0);
    }
    .pulse {
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    .floating {
      animation: floating 3s ease-in-out infinite;
    }
    @keyframes floating {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
  </style>
</head>
<body class="bg-gray-50">
  <header class="fixed top-0 w-full bg-white shadow-md z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex items-center space-x-8">
          <div class="logo">
            <img src="velveta.png" alt="Velveta Logo" class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover transition-transform duration-300 hover:rotate-12">
          </div>
          <nav class="hidden md:flex space-x-8">
            <a href="{{ route ('home') }}" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Home</a>
            <a href="{{ route ('menu') }}" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Menu</a>
            <a href="{{ route ('about') }}" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">About Us</a>
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
        </div>
      </div>
    </div>
  </header>

  <section class="pt-32 pb-20 bg-gradient-to-r from-red-700 to-amber-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-4xl md:text-6xl font-bold mb-6 font-montserrat">Velveta Rewards</h1>
      <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-8">Your loyalty deserves the best perks. Earn points with every purchase and unlock exclusive benefits.</p>
      <div class="flex justify-center space-x-4">
        <a href="#join" class="px-8 py-3 bg-white text-red-700 rounded-full font-bold hover:bg-gray-100 transition-colors duration-300">Join Now</a>
        <a href="#how-it-works" class="px-8 py-3 border-2 border-white text-white rounded-full font-bold hover:bg-white hover:text-red-700 transition-colors duration-300">How It Works</a>
      </div>
      <div class="mt-12 floating">
        <img src="https://cdn-icons-png.flaticon.com/512/3132/3132693.png" alt="Reward Cup" class="w-32 h-32 mx-auto">
      </div>
    </div>
  </section>

  <section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
      <div class="bg-gray-50 p-8 rounded-xl shadow-sm">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 font-montserrat">Your Rewards Progress</h2>
        
        <div class="mb-6">
          <div class="flex justify-between mb-2">
            <span class="font-medium">Silver Member</span>
            <span class="font-medium">150/300 points</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="progress-bar bg-amber-500 h-4 rounded-full" style="width: 50%"></div>
          </div>
        </div>
        
        <div class="grid grid-cols-3 gap-4 text-center">
          <div class="bg-white p-4 rounded-lg shadow-xs">
            <div class="text-2xl font-bold text-red-700">5</div>
            <div class="text-gray-600 text-sm">Stars Collected</div>
          </div>
          <div class="bg-white p-4 rounded-lg shadow-xs">
            <div class="text-2xl font-bold text-red-700">2</div>
            <div class="text-gray-600 text-sm">Free Drinks</div>
          </div>
          <div class="bg-white p-4 rounded-lg shadow-xs">
            <div class="text-2xl font-bold text-red-700">1</div>
            <div class="text-gray-600 text-sm">Months Member</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="how-it-works" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-900 mb-16 font-montserrat">How It Works</h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        <div class="fade-in">
          <div class="bg-white p-8 rounded-xl shadow-sm h-full reward-card">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <span class="text-2xl font-bold text-red-700">1</span>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-3">Join the Program</h3>
            <p class="text-gray-600 text-center">Sign up for free and start earning points immediately with every purchase.</p>
          </div>
        </div>
        
        <div class="fade-in" style="transition-delay: 0.2s">
          <div class="bg-white p-8 rounded-xl shadow-sm h-full reward-card">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <span class="text-2xl font-bold text-red-700">2</span>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-3">Earn Points</h3>
            <p class="text-gray-600 text-center">Get 1 point for every Rp10,000 spent. Bonus points on special promotions.</p>
          </div>
        </div>
        
        <div class="fade-in" style="transition-delay: 0.4s">
          <div class="bg-white p-8 rounded-xl shadow-sm h-full reward-card">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <span class="text-2xl font-bold text-red-700">3</span>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-3">Redeem Rewards</h3>
            <p class="text-gray-600 text-center">Exchange points for free drinks, discounts, and exclusive Velveta merchandise.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-900 mb-16 font-montserrat">Reward Tiers</h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        <div class="fade-in">
          <div class="bg-gray-50 border border-gray-200 p-8 rounded-xl h-full reward-card">
            <div class="text-center mb-6">
              <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-800">Silver</h3>
              <p class="text-gray-600">0-299 points</p>
            </div>
            <ul class="space-y-3 mb-6">
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>5% discount on all purchases</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Free birthday drink</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Early access to new products</span>
              </li>
            </ul>
            <div class="text-center">
              <span class="text-sm text-gray-500">Earn 300 points to reach Gold tier</span>
              <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                <div class="bg-gray-400 h-2 rounded-full" style="width: 50%"></div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="fade-in" style="transition-delay: 0.2s">
          <div class="bg-amber-50 border border-amber-200 p-8 rounded-xl h-full reward-card transform scale-105 pulse">
            <div class="text-center mb-6">
              <div class="w-20 h-20 bg-amber-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m8-8v13m-8-13V8m-8 8v13" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-800">Gold</h3>
              <p class="text-gray-600">300-699 points</p>
            </div>
            <ul class="space-y-3 mb-6">
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>10% discount on all purchases</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Free drink every 5 purchases</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Exclusive Gold member events</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Free birthday dessert</span>
              </li>
            </ul>
            <div class="text-center">
              <span class="text-sm text-gray-500">Earn 700 points to reach Platinum tier</span>
              <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                <div class="bg-amber-400 h-2 rounded-full" style="width: 30%"></div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="fade-in" style="transition-delay: 0.4s">
          <div class="bg-gray-100 border border-gray-300 p-8 rounded-xl h-full reward-card">
            <div class="text-center mb-6">
              <div class="w-20 h-20 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-800">Platinum</h3>
              <p class="text-gray-600">700+ points</p>
            </div>
            <ul class="space-y-3 mb-6">
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>15% discount on all purchases</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Free drink every 3 purchases</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>VIP event invitations</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Free monthly specialty drink</span>
              </li>
              <li class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>Personalized barista service</span>
              </li>
            </ul>
            <div class="text-center">
              <span class="text-sm text-gray-500">You've reached the highest tier!</span>
              <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                <div class="bg-gray-600 h-2 rounded-full" style="width: 100%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="join" class="py-16 bg-red-700 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-in">
      <h2 class="text-3xl font-bold mb-6 font-montserrat">Join Velveta Rewards Today</h2>
      <p class="text-xl mb-8 max-w-2xl mx-auto">Sign up now and get your first drink on us! Plus, earn double points for your first month.</p>
      <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
        <input type="email" placeholder="Your email address" class="px-4 py-3 rounded-full text-gray-900">
        <button class="px-6 py-3 bg-white text-red-700 rounded-full font-bold hover:bg-gray-100 transition-colors duration-300">Join Now</button>
      </div>
      <p class="text-sm mt-4 text-red-200">Already a member? <a href="login.html" class="underline">Sign in</a></p>
    </div>
  </section>

  <section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-900 mb-12 font-montserrat">Frequently Asked Questions</h2>
      
      <div class="space-y-4">
        <div class="bg-white p-6 rounded-xl shadow-sm fade-in">
          <button class="faq-toggle w-full flex justify-between items-center">
            <h3 class="text-lg font-bold text-left text-gray-900">How do I earn points?</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div class="faq-content mt-3 text-gray-600 hidden">
            <p>You earn 1 point for every Rp10,000 spent at any Velveta Coffee location. Just provide your phone number or scan your member QR code at checkout to earn points. Special promotions may offer bonus points on select items.</p>
          </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-sm fade-in" style="transition-delay: 0.1s">
          <button class="faq-toggle w-full flex justify-between items-center">
            <h3 class="text-lg font-bold text-left text-gray-900">How do I redeem rewards?</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div class="faq-content mt-3 text-gray-600 hidden">
            <p>You can redeem rewards through the Velveta mobile app or by telling your barista at checkout. Available rewards will be shown in your account based on your current point balance and membership tier.</p>
          </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-sm fade-in" style="transition-delay: 0.2s">
          <button class="faq-toggle w-full flex justify-between items-center">
            <h3 class="text-lg font-bold text-left text-gray-900">Do points expire?</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div class="faq-content mt-3 text-gray-600 hidden">
            <p>Points expire after 6 months of account inactivity. As long as you make at least one purchase every 6 months, your points will remain active. We'll send you reminders before any points are set to expire.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <h3 class="text-xl font-bold mb-4">Velveta Coffee</h3>
          <p class="text-gray-400">Creating memorable coffee experiences since 2015.</p>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Quick Links</h3>
          <ul class="space-y-2 text-gray-400">
            <li><a href="menu.html" class="hover:text-white transition-colors duration-300">Menu</a></li>
            <li><a href="about.html" class="hover:text-white transition-colors duration-300">About Us</a></li>
            <li><a href="#" class="hover:text-white transition-colors duration-300">Rewards</a></li>
            <li><a href="locations.html" class="hover:text-white transition-colors duration-300">Locations</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Contact</h3>
          <ul class="space-y-2 text-gray-400">
            <li>📞 021-1234-5678</li>
            <li>✉️ hello@velvetacoffee.com</li>
            <li>📍 Jakarta, Indonesia</li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Follow Us</h3>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
        <p>© 2023 Velveta Coffee. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const progressBars = document.querySelectorAll('.progress-bar');
      progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
          bar.style.width = width;
        }, 300);
      });

      const faqToggles = document.querySelectorAll('.faq-toggle');
      faqToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
          const content = this.nextElementSibling;
          const icon = this.querySelector('svg');
          
          content.classList.toggle('hidden');
          icon.classList.toggle('rotate-180');
        });
      });

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('show');
          }
        });
      }, {
        threshold: 0.1
      });
    
      document.querySelectorAll('.fade-in').forEach((el, index) => {
        el.style.transitionDelay = `${index * 0.1}s`;
        observer.observe(el);
      });
    });
  </script>
  
</body>
</html>