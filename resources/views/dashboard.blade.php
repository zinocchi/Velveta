<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Velveta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
    }
    
    .dashboard-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      border: 1px solid #e2e8f0;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .dashboard-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .menu-item {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .menu-item:hover {
      transform: scale(1.02) rotate(-1deg);
    }
    
    .cart-item {
      animation: slideIn 0.3s ease-out;
    }
    
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    .profile-avatar {
      transition: all 0.3s ease;
    }
    
    .profile-avatar:hover {
      transform: scale(1.05) rotate(5deg);
    }
    
    .sidebar-link {
      position: relative;
      overflow: hidden;
    }
    
    .sidebar-link::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 3px;
      background: linear-gradient(to bottom, #9B111E, #dc2626);
      transform: scaleY(0);
      transition: transform 0.3s ease;
    }
    
    .sidebar-link:hover::before {
      transform: scaleY(1);
    }
    
    .notification-dot {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
    
    .modal {
      backdrop-filter: blur(10px);
      background: rgba(0, 0, 0, 0.5);
    }
    
    .modal-content {
      animation: modalSlide 0.3s ease-out;
    }
    
    @keyframes modalSlide {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="bg-gray-50">
  <header class="fixed top-0 w-full bg-white shadow-md z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center space-x-6">
        </div>
        <div class="absolute left-20 top-1/2 transform -translate-y-1/2">
          <img src="velveta.png" alt="Velveta Logo" class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover transition-transform duration-300 hover:rotate-12">
        </div>
        <div class="flex items-center space-x-4">
          <button id="cartToggle" class="relative p-2 text-gray-600 hover:text-red-700 transition-colors duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 10H3m4 3a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z"/>
            </svg>
            <span id="cartCount" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center notification-dot">0</span>
          </button>
          
          <div class="relative">
            <button id="profileToggle" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-300">
              <img id="profileImage" src="hitori.jpeg" alt="Profile" class="w-8 h-8 rounded-full profile-avatar">
              <span id="profileName" class="text-sm font-medium text-gray-900"></span>
            </button>
            
            <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden">
              <div class="py-1">
                <button id="editProfileBtn" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</button>
                <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</button>
                <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t">Logout</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="pt-16 flex">
    <aside class="w-64 bg-white shadow-sm h-screen sticky top-16 overflow-y-auto">
      <div class="p-6">
        <nav class="space-y-2">
          <a href="#" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7z"/>
            </svg>
            <span class="font-medium">Dashboard</span>
          </a>
          
          <a href="#" id="menuSection" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"/>
            </svg>
            <span class="font-medium">Menu</span>
          </a>
          
          <a href="#" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="font-medium">Orders</span>
          </a>
          
          <a href="#" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span class="font-medium">Favorites</span>
          </a>
        </nav>
      </div>
    </aside>

    <main class="flex-1 p-8">
      <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2 font-montserrat">Welcome, <span id="welcomeName">Hitori</span>!</h2>
        <p class="text-gray-600">Ready to explore our premium coffee selection?</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="dashboard-card rounded-xl p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Total Orders</p>
              <p class="text-2xl font-bold text-gray-900">12</p>
            </div>
            <div class="p-3 bg-red-100 rounded-full">
              <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="dashboard-card rounded-xl p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Points Earned</p>
              <p class="text-2xl font-bold text-gray-900">350</p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
              <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
              </svg>
            </div>
          </div>
        </div>
        
        <div class="dashboard-card rounded-xl p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Favorite Drinks</p>
              <p class="text-2xl font-bold text-gray-900">8</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 font-montserrat">Featured Menu</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menuGrid">
        </div>
      </div>
    </main>
  </div>

  <div id="cartSidebar" class="fixed right-0 top-0 h-full w-80 bg-white shadow-xl transform translate-x-full transition-transform duration-300 z-50">
    <div class="p-6 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900">Your Cart</h3>
        <button id="closeCart" class="text-gray-400 hover:text-gray-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
    
    <div class="flex-1 overflow-y-auto p-6">
      <div id="cartItems" class="space-y-4">
      </div>
    </div>
    
    <div class="border-t border-gray-200 p-6">
      <div class="flex justify-between items-center mb-4">
        <span class="text-lg font-semibold text-gray-900">Total: </span>
        <span id="cartTotal" class="text-lg font-bold text-red-600">$0.00</span>
      </div>
      <button class="w-full bg-red-700 text-white py-3 px-4 rounded-lg font-medium hover:bg-red-800 transition-colors duration-300">
        Checkout
      </button>
    </div>
  </div>

  <div id="profileModal" class="fixed inset-0 modal hidden z-50 flex items-center justify-center p-4">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md">
      <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Profile</h3>
      </div>
      
      <div class="p-6">
        <div class="space-y-4">
          <div class="text-center">
            <img id="modalProfileImage" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Profile" class="w-20 h-20 rounded-full mx-auto mb-4">
            <button id="changePhotoBtn" class="text-red-600 hover:text-red-700 font-medium text-sm">Change Photo</button>
            <input type="file" id="photoInput" accept="image/*" class="hidden">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
            <input type="text" id="usernameInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" id="emailInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>
        </div>
      </div>
      
      <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
        <button id="cancelEdit" class="px-4 py-2 text-gray-700 hover:text-gray-900">Cancel</button>
        <button id="saveProfile" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">Save Changes</button>
      </div>
    </div>
  </div>

  <script>
    const menuData = [
      {
        id: 1,
        name: 'Espresso',
        category: 'Hot Coffee',
        price: 4.50,
        image: 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=300&h=200&fit=crop',
        description: 'Rich, bold espresso shot'
      },
      {
        id: 2,
        name: 'Cappuccino',
        category: 'Hot Coffee',
        price: 5.25,
        image: 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=300&h=200&fit=crop',
        description: 'Perfectly balanced coffee and steamed milk'
      },
      {
        id: 3,
        name: 'Iced Latte',
        category: 'Cold Coffee',
        price: 5.75,
        image: 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=300&h=200&fit=crop',
        description: 'Smooth espresso with cold milk over ice'
      },
      {
        id: 4,
        name: 'Green Tea',
        category: 'Hot Tea',
        price: 3.50,
        image: 'https://images.unsplash.com/photo-1556881286-fc3ca6d05413?w=300&h=200&fit=crop',
        description: 'Refreshing green tea blend'
      },
      {
        id: 5,
        name: 'Chocolate Croissant',
        category: 'Bakery',
        price: 4.25,
        image: 'https://images.unsplash.com/photo-1555507036-ab794f4aba18?w=300&h=200&fit=crop',
        description: 'Buttery croissant with rich chocolate'
      },
      {
        id: 6,
        name: 'Avocado Toast',
        category: 'Breakfast',
        price: 7.50,
        image: 'https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=300&h=200&fit=crop',
        description: 'Fresh avocado on artisan bread'
      }
    ];

    let cart = [];
    let cartCount = 0;
    let cartTotal = 0;

    let userProfile = {
      name: 'John Doe',
      email: 'john@example.com',
      image: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face'
    };

    const cartToggle = document.getElementById('cartToggle');
    const cartSidebar = document.getElementById('cartSidebar');
    const closeCart = document.getElementById('closeCart');
    const cartItems = document.getElementById('cartItems');
    const cartCountEl = document.getElementById('cartCount');
    const cartTotalEl = document.getElementById('cartTotal');
    const menuGrid = document.getElementById('menuGrid');
    const profileToggle = document.getElementById('profileToggle');
    const profileDropdown = document.getElementById('profileDropdown');
    const profileModal = document.getElementById('profileModal');
    const editProfileBtn = document.getElementById('editProfileBtn');

    function initDashboard() {
      renderMenu();
      updateProfile();
      
      cartToggle.addEventListener('click', toggleCart);
      closeCart.addEventListener('click', toggleCart);
      profileToggle.addEventListener('click', toggleProfileDropdown);
      editProfileBtn.addEventListener('click', openProfileModal);
      
      document.getElementById('cancelEdit').addEventListener('click', closeProfileModal);
      document.getElementById('saveProfile').addEventListener('click', saveProfileChanges);
      document.getElementById('changePhotoBtn').addEventListener('click', () => {
        document.getElementById('photoInput').click();
      });
      document.getElementById('photoInput').addEventListener('change', handlePhotoChange);
      
      document.addEventListener('click', (e) => {
        if (!profileToggle.contains(e.target)) {
          profileDropdown.classList.add('hidden');
        }
        if (!cartSidebar.contains(e.target) && !cartToggle.contains(e.target)) {
          cartSidebar.classList.add('translate-x-full');
        }
      });
    }

    function renderMenu() {
      menuGrid.innerHTML = '';
      menuData.forEach(item => {
        const menuItem = document.createElement('div');
        menuItem.className = 'menu-item dashboard-card rounded-xl overflow-hidden cursor-pointer';
        menuItem.innerHTML = `
          <div class="relative">
            <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="p-4">
            <div class="flex justify-between items-start mb-2">
              <h4 class="text-lg font-semibold text-gray-900">${item.name}</h4>
              <span class="text-lg font-bold text-red-600">$${item.price.toFixed(2)}</span>
            </div>
            <p class="text-gray-600 text-sm mb-3">${item.description}</p>
            <button onclick="addToCart(${item.id})" class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition-colors duration-300 flex items-center justify-center space-x-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
              <span>Add to Cart</span>
            </button>
          </div>
        `;
        menuGrid.appendChild(menuItem);
      });
    }

    function addToCart(itemId) {
      const item = menuData.find(item => item.id === itemId);
      const existingItem = cart.find(cartItem => cartItem.id === itemId);
      
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({...item, quantity: 1});
      }
      
      updateCart();
      
        const button = event.target;
      button.innerHTML = '<span>Added!</span>';
      button.classList.add('bg-green-600');
      setTimeout(() => {
        button.innerHTML = `
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
          </svg>
          <span>Add to Cart</span>
        `;
        button.classList.remove('bg-green-600');
      }, 1000);
    }

    function updateCart() {
      cartCount = cart.reduce((total, item) => total + item.quantity, 0);
      cartTotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      
      cartCountEl.textContent = cartCount;
      cartTotalEl.textContent = `$${cartTotal.toFixed(2)}`;
      
=      cartItems.innerHTML = '';
      cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item flex items-center space-x-3 p-3 bg-gray-50 rounded-lg';
        cartItem.innerHTML = `
          <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded-lg">
          <div class="flex-1">
            <h5 class="font-medium text-gray-900">${item.name}</h5>
            <p class="text-sm text-gray-600">$${item.price.toFixed(2)}</p>
          </div>
          <div class="flex items-center space-x-2">
            <button onclick="updateQuantity(${item.id}, -1)" class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 transition-colors">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
              </svg>
            </button>
            <span class="w-8 text-center font-medium">${item.quantity}</span>
            <button onclick="updateQuantity(${item.id}, 1)" class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 transition-colors">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
            </button>
          </div>
        `;
        cartItems.appendChild(cartItem);
      });
    }

    function updateQuantity(itemId, change) {
      const item = cart.find(cartItem => cartItem.id === itemId);
      if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
          cart = cart.filter(cartItem => cartItem.id !== itemId);
        }
        updateCart();
      }
    }

    function toggleCart() {
      cartSidebar.classList.toggle('translate-x-full');
    }