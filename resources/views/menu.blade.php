<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu - Velveta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
    }
    .menu-highlight {
      position: relative;
    }
    .menu-highlight::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: #9B111E;
      transform-origin: left;
      transform: scaleX(1);
      transition: transform 0.3s ease;
    }
    .menu-item:hover .menu-img {
      transform: scale(1.05) rotate(-2deg);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .menu-img {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .sidebar-link {
      position: relative;
    }
    .sidebar-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #9B111E;
      transition: width 0.3s ease;
    }
    .sidebar-link:hover::after {
      width: 100%;
    }
    .category-title {
      position: relative;
      display: inline-block;
    }
    .category-title::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 50px;
      height: 3px;
      background-color: #9B111E;
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
            <a href="about" class="text-gray-900 hover:text-red-700 font-semibold uppercase text-sm tracking-wider transition-colors duration-300">About Us</a>
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
          @guest
          <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-800 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors duration-300">Sign in</a>
          <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition-colors duration-300">Join now</a>
          @endguest
        </div>
      </div>
    </div>
  </header>
  <main class="pt-28 pb-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row">
      <aside class="w-full md:w-64 flex-shrink-0 mb-8 md:mb-0 md:mr-8">
        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-32">
          <h2 class="font-bold text-xl text-gray-900 mb-6 font-montserrat">Categories</h2>

          <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 font-montserrat">Drinks</h3>
            <ul class="space-y-2">
              <li><a href="#hot-coffee" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Hot Coffee</a></li>
              <li><a href="#cold-coffee" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Cold Coffee</a></li>
              <li><a href="#hot-tea" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Hot Tea</a></li>
              <li><a href="#cold-tea" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Cold Tea</a></li>
              <li><a href="#hot-chocolate" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Hot Chocolate & More</a></li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3 font-montserrat">Food</h3>
            <ul class="space-y-2">
              <li><a href="#breakfast" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Breakfast</a></li>
              <li><a href="#bakery" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Bakery</a></li>
              <li><a href="#treats" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Treats</a></li>
              <li><a href="#lunch" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Lunch</a></li>
              <li><a href="#snack" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300">Snacks</a></li>

            </ul>
          </div>
        </div>
      </aside>

      <div class="flex-1">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 font-montserrat">Our Menu</h1>
        <p class="text-gray-600 mb-8">Discover our premium selection of coffees and delicious food pairings</p>

        <section id="drinks" class="mb-16">
          <h2 class="category-title text-2xl font-bold text-gray-900 mb-8 font-montserrat">Drinks</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            <a href="{{ route('drinks.hot-coffe') }}" id="hot-coffee" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/bev/CaffeLatte.jpg"
                       alt="Hot Coffee"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Hot Coffee</h3>
                <p class="text-gray-600 text-sm">Rich, aromatic coffee served hot</p>
              </div>
            </a>

            <a href="{{ route('drinks.cold-coffe') }}" id="cold-coffee" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/bev/VanillaSweetCreamColdBrew.jpg"
                       alt="Cold Coffee"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Cold Coffee</h3>
                <p class="text-gray-600 text-sm">Refreshing iced coffee creations</p>
              </div>
            </a>

            <a href="{{ route('drinks.hot-tea') }}" id="hot-tea" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/bev/HoneyCitrusMintTea.jpg"
                       alt="Hot Tea"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Hot Tea</h3>
                <p class="text-gray-600 text-sm">Soothing herbal and classic teas</p>
              </div>
            </a>

            <a href="{{ route('drinks.cold-tea') }}" id="cold-tea" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/bev/IcedBlackTea.jpg"
                       alt="Cold Tea"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Cold Tea</h3>
                <p class="text-gray-600 text-sm">Refreshing iced tea varieties</p>
              </div>
            </a>



            <a href="{{ route ('drinks.hot-chocolate') }}" id="hot-chocolate" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/bev/HotChocolate.jpg"
                       alt="Hot Chocolate"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Hot Chocolate</h3>
                <p class="text-gray-600 text-sm">Rich, creamy chocolate drinks</p>
              </div>
            </a>
          </div>
        </section>

        <section id="food">
          <h2 class="category-title text-2xl font-bold text-gray-900 mb-8 font-montserrat">Food</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            <a href="{{ route('food.breakfast') }}" id="breakfast" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/food/EggPestoMozzarellaSandwich.jpg"
                       alt="Breakfast"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Breakfast</h3>
                <p class="text-gray-600 text-sm">Morning favorites to start your day</p>
              </div>
            </a>

            <a href="{{ route('desert.bakery') }}" id="bakery" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/food/SBX20210915_Croissant-onGreen.jpg"
                       alt="Bakery"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Bakery</h3>
                <p class="text-gray-600 text-sm">Freshly baked pastries and breads</p>
              </div>
            </a>

            <a href="{{ route('desert.treats') }}" id="treats" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/food/SBX20181129_BirthdayCakePop.jpg"
                       alt="Treats"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Treats</h3>
                <p class="text-gray-600 text-sm">Sweet indulgences for any time</p>
              </div>
            </a>

            <a href="{{ route('food.lunch') }}" id="lunch" class="menu-item group">
              <div class="bg-white rounded-xl shadow-sm overflow-hidden p-4 h-full flex flex-col">
                <div class="relative overflow-hidden rounded-lg mb-4">
                  <img src="https://globalassets.starbucks.com/digitalassets/products/food/SBX20220207_GrilledCheeseOnSourdough_US.jpg"
                       alt="Lunch"
                       class="menu-img w-full h-40 object-cover rounded-lg">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Lunch</h3>
                <p class="text-gray-600 text-sm">Satisfying midday meals</p>
              </div>
            </a>
        </section>
      </div>
    </div>
  </main>

  <script>
    document.querySelectorAll('.sidebar-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 120,
            behavior: 'smooth'
          });
        }
      });
    });

    const menuItems = document.querySelectorAll('.menu-item');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    menuItems.forEach(item => {
      item.style.opacity = '0';
      item.style.transform = 'translateY(20px)';
      item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(item);
    });

    const categoryTitles = document.querySelectorAll('.category-title');
    categoryTitles.forEach(title => {
      title.addEventListener('mouseenter', () => {
        const underline = title.querySelector('::after');
        if (underline) {
          underline.style.transform = 'scaleX(1)';
        }
      });
    });
  </script>
</body>
</html>
