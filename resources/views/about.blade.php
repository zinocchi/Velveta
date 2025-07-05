<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Velveta Coffee</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
    }
    .hero-overlay {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4));
    }
    .menu-item {
      transition: all 0.3s ease;
    }
    .menu-item:hover {
      transform: translateY(-5px);
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
    .underline-animation {
      position: relative;
    }
    .underline-animation::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #9B111E;
      transition: width 0.3s ease;
    }
    .underline-animation:hover::after {
      width: 100%;
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
            <a href="/" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Home</a>
            <a href="menu" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Menu</a>
            <a href="reward" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">Reward</a>
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
          <a href="login" class="px-4 py-2 border border-gray-800 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors duration-300">Sign in</a>
          <a href="join" class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition-colors duration-300">Join now</a>
        </div>
      </div>
    </div>
  </header>

  <section class="relative h-96 md:h-screen max-h-[600px] bg-cover bg-center mt-20" style="background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')">
    <div class="hero-overlay absolute inset-0 flex items-center justify-center">
      <div class="text-center px-4">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 font-playfair">Our Story</h1>
        <p class="text-xl md:text-2xl text-white max-w-2xl mx-auto">Discover the passion behind every cup of Velveta Coffee</p>
      </div>
    </div>
  </section>

  <section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2 fade-in">
          <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
               alt="Coffee Shop Interior" 
               class="rounded-xl shadow-xl w-full h-auto">
        </div>
        <div class="md:w-1/2 fade-in">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-playfair">About Us</h2>
          <div class="space-y-4 text-gray-700">
            <p>Velveta Coffee, also known as Sunset Coffee, offers delightful coffee and beverages to help you relax under the beautiful sunset.</p>
            <p>We are committed to providing you with a moment of respite from the hustle and bustle of daily life.</p>
            <p>Every cup of our coffee is brewed with love and care, using premium coffee beans sourced from local farmers.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-playfair">Our Mission</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Creating unforgettable coffee experiences with the best quality</p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-xl shadow-md text-center fade-in">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Premium Quality</h3>
          <p class="text-gray-600">We only use selected coffee beans with perfect roasting process</p>
        </div>
        
        <div class="bg-white p-8 rounded-xl shadow-md text-center fade-in" style="transition-delay: 0.2s">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Special Moments</h3>
          <p class="text-gray-600">Every cup is crafted to create special moments in your day</p>
        </div>
        
        <div class="bg-white p-8 rounded-xl shadow-md text-center fade-in" style="transition-delay: 0.4s">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Eco-Friendly</h3>
          <p class="text-gray-600">We are committed to sustainable and environmentally friendly business practices</p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-playfair">Signature Products</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Our signature products that make Velveta Coffee special</p>
      </div>
      
      <div class="space-y-12">
        <div class="flex flex-col md:flex-row items-center gap-8 bg-gray-50 p-6 rounded-xl fade-in">
          <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
               alt="Ballerinna Cappuccino" 
               class="w-full md:w-1/3 h-64 object-cover rounded-lg">
          <div class="md:w-2/3">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Ballerinna Cappuccino</h3>
            <p class="text-gray-600 mb-4">Authentic Italian cappuccino with our barista's sweet touch. Made with high-quality espresso and perfectly steamed milk.</p>
            <div class="flex items-center space-x-2">
              <span class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded">Best Seller</span>
              <span class="text-gray-500">★ ★ ★ ★ ★</span>
            </div>
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-8 bg-gray-50 p-6 rounded-xl fade-in" style="transition-delay: 0.2s">
          <img src="https://globalassets.starbucks.com/digitalassets/products/bev/IcedMatchaTeaLatte.jpg?impolicy=1by1_wide_topcrop_630" 
               alt="Our Matcha" 
               class="w-full md:w-1/3 h-64 object-cover rounded-lg">
          <div class="md:w-2/3">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Our Matcha</h3>
            <p class="text-gray-600 mb-4">Delicious matcha for green tea lovers. Made from ceremonial grade matcha powder from Japan, perfectly whisked.</p>
            <div class="flex items-center space-x-2">
              <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">Healthy</span>
            </div>
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-8 bg-gray-50 p-6 rounded-xl fade-in" style="transition-delay: 0.4s">
          <img src="https://globalassets.starbucks.com/digitalassets/products/bev/IcedShakenEspresso.jpg?impolicy=1by1_wide_topcrop_630" 
               alt="Americanno" 
               class="w-full md:w-1/3 h-64 object-cover rounded-lg">
          <div class="md:w-2/3">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Americanno</h3>
            <p class="text-gray-600 mb-4">For true black coffee connoisseurs. Strong espresso diluted with hot water, delivering authentic coffee flavor.</p>
            <div class="flex items-center space-x-2">
              <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">Strong</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-playfair">Our Locations</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Find our coffee shops in various cities</p>
      </div>
      
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="https://maps.google.com" target="_blank" class="menu-item bg-white rounded-xl shadow-md overflow-hidden fade-in">
          <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
               alt="Jakarta Branch" 
               class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-bold text-lg mb-1">Sunset Coffee - South Jakarta</h3>
            <p class="text-gray-600 text-sm">📍 Jl. Sudirman Kav. 52-53</p>
          </div>
        </a>
        
        <a href="https://maps.google.com" target="_blank" class="menu-item bg-white rounded-xl shadow-md overflow-hidden fade-in" style="transition-delay: 0.1s">
          <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
               alt="Bandung Branch" 
               class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-bold text-lg mb-1">Sunset Coffee - Bandung</h3>
            <p class="text-gray-600 text-sm">📍 Jl. Riau No. 23</p>
          </div>
        </a>
        
        <a href="https://maps.google.com" target="_blank" class="menu-item bg-white rounded-xl shadow-md overflow-hidden fade-in" style="transition-delay: 0.2s">
          <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
               alt="Yogyakarta Branch" 
               class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-bold text-lg mb-1">Sunset Coffee - Yogyakarta</h3>
            <p class="text-gray-600 text-sm">📍 Jl. Malioboro No. 123</p>
          </div>
        </a>
        
        <a href="https://maps.google.com" target="_blank" class="menu-item bg-white rounded-xl shadow-md overflow-hidden fade-in" style="transition-delay: 0.3s">
          <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
               alt="Surabaya Branch" 
               class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-bold text-lg mb-1">Sunset Coffee - Surabaya</h3>
            <p class="text-gray-600 text-sm">📍 Jl. Tunjungan No. 45</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-xl font-bold mb-4">Velveta Coffee</h3>
          <p class="text-gray-400">Creating special moments with every cup of coffee since 2015.</p>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Contact Us</h3>
          <ul class="space-y-2 text-gray-400">
            <li>📍 Coffee Street No. 123, Jakarta</li>
            <li>📞 +62 812-3456-7890</li>
            <li>✉️ hello@velvetacoffee.com</li>
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
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.1
    });
  
    document.querySelectorAll('.fade-in').forEach(el => {
      observer.observe(el);
    });

    document.querySelectorAll('.fade-in').forEach((el, index) => {
      el.style.transitionDelay = `${index * 0.1}s`;
    });
  </script>
</body>
</html>