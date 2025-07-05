<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hot Coffee - Velveta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
    }
    .menu-item {
      transition: all 0.3s ease;
    }
    .menu-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
    .active-category {
      color: #9B111E !important;
      font-weight: bold;
    }
    .active-category::after {
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
          <a href="login" class="px-4 py-2 border border-gray-800 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors duration-300">Sign in</a>
          <a href="join" class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm font-medium hover:bg-gray-700 transition-colors duration-300">Join now</a>
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
              <li><a href="hot-coffee" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation ">Hot Coffee</a></li>
              <li><a href="cold-coffe" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Cold Coffee</a></li>
              <li><a href="hot-tea" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Hot Tea</a></li>
              <li><a href="cold-tea" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Cold Tea</a></li>
              <li><a href="hot-chocolate" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation ">Hot Chocolate & More</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3 font-montserrat">Food</h3>
            <ul class="space-y-2">
              <li><a href="breakfast" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Breakfast</a></li>
              <li><a href="bakery" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Bakery</a></li>
              <li><a href="treats" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Treats</a></li>
              <li><a href="lunch" class="sidebar-link text-gray-600 hover:text-red-700 block py-1 transition-colors duration-300 underline-animation">Lunch</a></li>
            </ul>
          </div>
        </div>
      </aside>

      <div class="flex-1">
        <div class="flex items-center text-sm text-gray-600 mb-4 fade-in">
          <a href="menu" class="hover:text-red-700 transition-colors duration-300">Menu</a>
          <span class="mx-2">/</span>
          <span class="text-red-700">Breakfast</span>
        </div>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 font-montserrat fade-in">Breakfast Menu</h1>
        <p class="text-gray-600 mb-8 fade-in">Comfort on a plate—breakfast made for slow mornings.</p>

        <section id="latte" class="mb-16 fade-in">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="menu-item bg-white rounded-xl shadow-sm overflow-hidden">
              <div class="relative overflow-hidden rounded-t-xl aspect-square">
                <img src="https://globalassets.starbucks.com/digitalassets/products/food/EggPestoMozzarellaSandwich.jpg?impolicy=1by1_medium_630" 
                     alt="Caffè Latte" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                  <span class="text-white font-semibold">View Details</span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Egg, Pesto & Mozzarella Sandwich</h3>
                <p class="text-gray-600 text-sm mb-3"></p>
                <div class="flex justify-between items-center">
                  <span class="font-bold text-red-700">Rp 85.000</span>
                  <button class="add-to-cart px-3 py-1 bg-red-700 text-white rounded-full text-sm hover:bg-red-800 transition-colors duration-300">
                    + Add
                  </button>
                </div>
              </div>
            </div>
            
            <div class="menu-item bg-white rounded-xl shadow-sm overflow-hidden">
              <div class="relative overflow-hidden rounded-t-xl aspect-square">
                <img src="https://globalassets.starbucks.com/digitalassets/products/food/SBX20191018_BaconSausageCageFreeEggWrap.jpg?impolicy=1by1_medium_630" 
                     alt="Lavender Oatmilk Latte" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                  <span class="text-white font-semibold">View Details</span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Bacon, Sausage & Egg Wrap</h3>
                <p class="text-gray-600 text-sm mb-3"></p>
                <div class="flex justify-between items-center">
                  <span class="font-bold text-red-700">Rp65.000</span>
                  <button class="add-to-cart px-3 py-1 bg-red-700 text-white rounded-full text-sm hover:bg-red-800 transition-colors duration-300">
                    + Add
                  </button>
                </div>
              </div>
            </div>
            
            <div class="menu-item bg-white rounded-xl shadow-sm overflow-hidden">
              <div class="relative overflow-hidden rounded-t-xl aspect-square">
                <img src="https://globalassets.starbucks.com/digitalassets/products/food/SBX20190814_AvocadoSpread.jpg?impolicy=1by1_medium_630" 
                     alt="Cinnamon Dolce Latte" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                  <span class="text-white font-semibold">View Details</span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Avocado Spread</h3>
                <p class="text-gray-600 text-sm mb-3"></p>
                <div class="flex justify-between items-center">
                  <span class="font-bold text-red-700">Rp 30.000</span>
                  <button class="add-to-cart px-3 py-1 bg-red-700 text-white rounded-full text-sm hover:bg-red-800 transition-colors duration-300">
                    + Add
                  </button>
                </div>
              </div>
            </div>
            
            <div class="menu-item bg-white rounded-xl shadow-sm overflow-hidden">
              <div class="relative overflow-hidden rounded-t-xl aspect-square">
                <img src="https://globalassets.starbucks.com/digitalassets/products/food/SBX20210915_BaconGoudaEggSandwich.jpg?impolicy=1by1_medium_630" 
                     alt="Pistachio Latte" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                  <span class="text-white font-semibold">View Details</span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Bacon, Gouda & Egg Sandwich e</h3>
                <p class="text-gray-600 text-sm mb-3"></p>
                <div class="flex justify-between items-center">
                  <span class="font-bold text-red-700">Rp 85.000</span>
                  <button class="add-to-cart px-3 py-1 bg-red-700 text-white rounded-full text-sm hover:bg-red-800 transition-colors duration-300">
                    + Add
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>

      

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const originalText = this.textContent;
          
          this.textContent = 'Added!';
          this.classList.remove('bg-red-700');
          this.classList.add('bg-green-600');
          
          setTimeout(() => {
            this.textContent = originalText;
            this.classList.remove('bg-green-600');
            this.classList.add('bg-red-700');
          }, 1500);
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

      const currentPage = window.location.pathname.split('/').pop();
      document.querySelectorAll('.sidebar-link').forEach(link => {
        if (link.getAttribute('href') === currentPage) {
          link.classList.add('active-category');
        }
      });
    });
  </script>
</body>
</html> 