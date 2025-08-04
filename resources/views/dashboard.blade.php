<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Velveta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    
    .sidebar-link.active::before,
    .sidebar-link:hover::before {
      transform: scaleY(1);
    }
    
    .sidebar-link.active {
      background-color: #fef2f2;
      color: #dc2626;
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
    
    .tab-content {
      display: none;
    }
    
    .tab-content.active {
      display: block;
      animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    .favorite-btn.active {
      color: #dc2626;
    }
    
    .order-status {
      display: inline-block;
      padding: 0.25rem 0.5rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .status-preparing {
      background-color: #fef3c7;
      color: #d97706;
    }
    
    .status-ready {
      background-color: #d1fae5;
      color: #059669;
    }
    
    .status-delivered {
      background-color: #e0e7ff;
      color: #4f46e5;
    }
    
    .status-cancelled {
      background-color: #fee2e2;
      color: #dc2626;
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
          <button id="notificationToggle" class="relative p-2 text-gray-600 hover:text-red-700 transition-colors duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span id="notificationCount" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center notification-dot hidden">0</span>
          </button>
          
          <button id="cartToggle" class="relative p-2 text-gray-600 hover:text-red-700 transition-colors duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 10H3m4 3a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z"/>
            </svg>
            <span id="cartCount" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center notification-dot">0</span>
          </button>
          
          <div class="relative">
            <button id="profileToggle" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-300">
              <img id="profileImage" src="" alt="Profile" class="w-8 h-8 rounded-full profile-avatar">
              <span id="profileName" class="text-sm font-medium text-gray-900 hidden md:inline"></span>
            </button>
            
            <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">
              <div class="py-1">
                <button id="editProfileBtn" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-user-edit mr-2"></i>Edit Profile
                </button>
                <button id="viewOrdersBtn" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-history mr-2"></i>Order History
                </button>
                <button id="viewFavoritesBtn" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-heart mr-2"></i>Favorites
                </button>
                <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t">
                  <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
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
          <a href="#" data-tab="dashboard" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7z"/>
            </svg>
            <span class="font-medium">Dashboard</span>
          </a>
          
          <a href="#" data-tab="menu" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"/>
            </svg>
            <span class="font-medium">Menu</span>
          </a>
          
          <a href="#" data-tab="orders" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="font-medium">Orders</span>
            <span id="ordersCount" class="ml-auto bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded-full">0</span>
          </a>
          
          <a href="#" data-tab="favorites" class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-red-700 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span class="font-medium">Favorites</span>
            <span id="favoritesCount" class="ml-auto bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded-full">0</span>
          </a>
        </nav>
      </div>
    </aside>

    <main class="flex-1 p-8">
      <div id="dashboard" class="tab-content active">
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900 mb-2 font-montserrat">Welcome, <span id="welcomeName">Hitori</span>!</h2>
          <p class="text-gray-600">Ready to explore our premium coffee selection?</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div class="dashboard-card rounded-xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                <p id="totalOrdersCount" class="text-2xl font-bold text-gray-900">12</p>
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
                <p id="pointsEarned" class="text-2xl font-bold text-gray-900">350</p>
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
                <p id="favoriteDrinksCount" class="text-2xl font-bold text-gray-900">8</p>
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
          <h3 class="text-2xl font-bold text-gray-900 mb-6 font-montserrat">Recent Orders</h3>
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div id="recentOrders" class="divide-y divide-gray-200">
            </div>
          </div>
        </div>
      </div>

      <div id="menu" class="tab-content">
        <div class="mb-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 font-montserrat">Our Menu</h3>
          <div class="flex flex-wrap gap-2 mb-6">
            <button class="menu-filter px-4 py-2 rounded-full bg-red-700 text-white" data-category="all">All</button>
            <button class="menu-filter px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300" data-category="Hot Coffee">Hot Coffee</button>
            <button class="menu-filter px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300" data-category="Cold Coffee">Cold Coffee</button>
            <button class="menu-filter px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300" data-category="Hot Tea">Hot Tea</button>
            <button class="menu-filter px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300" data-category="Bakery">Bakery</button>
            <button class="menu-filter px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300" data-category="Breakfast">Breakfast</button>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menuGrid">
          </div>
        </div>
      </div>

      <div id="orders" class="tab-content">
        <div class="mb-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 font-montserrat">Your Orders</h3>
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div id="orderHistory" class="divide-y divide-gray-200">
            </div>
          </div>
        </div>
      </div>

      <div id="favorites" class="tab-content">
        <div class="mb-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 font-montserrat">Your Favorites</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="favoritesGrid">
          </div>
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
      <button id="checkoutBtn" class="w-full bg-red-700 text-white py-3 px-4 rounded-lg font-medium hover:bg-red-800 transition-colors duration-300">
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
            <img id="modalProfileImage" src="hitori.jpeg" alt="Profile" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
            <button id="changePhotoBtn" class="text-red-600 hover:text-red-700 font-medium text-sm">
              <i class="fas fa-camera mr-1"></i>Change Photo
            </button>
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
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
            <input type="tel" id="phoneInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>
        </div>
      </div>
      
      <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
        <button id="cancelEdit" class="px-4 py-2 text-gray-700 hover:text-gray-900">Cancel</button>
        <button id="saveProfile" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">Save Changes</button>
      </div>
    </div>
  </div>

  <div id="orderDetailModal" class="fixed inset-0 modal hidden z-50 flex items-center justify-center p-4">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md">
      <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-900">Order Details</h3>
          <button id="closeOrderDetail" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>
      
      <div class="p-6">
        <div class="mb-4">
          <p class="text-sm text-gray-500">Order ID</p>
          <p id="detailOrderId" class="font-medium">#12345</p>
        </div>
        
        <div class="mb-4">
          <p class="text-sm text-gray-500">Date</p>
          <p id="detailOrderDate" class="font-medium">June 15, 2023</p>
        </div>
        
        <div class="mb-4">
          <p class="text-sm text-gray-500">Status</p>
          <p id="detailOrderStatus" class="font-medium">Completed</p>
        </div>
        
        <div class="mb-4">
          <p class="text-sm text-gray-500">Items</p>
          <div id="detailOrderItems" class="mt-2 space-y-2">
            <!-- Order items will be populated here -->
          </div>
        </div>
        
        <div class="border-t border-gray-200 pt-4">
          <div class="flex justify-between">
            <p class="text-sm text-gray-500">Subtotal</p>
            <p id="detailSubtotal" class="font-medium">$15.50</p>
          </div>
          <div class="flex justify-between mt-1">
            <p class="text-sm text-gray-500">Tax</p>
            <p id="detailTax" class="font-medium">$1.40</p>
          </div>
          <div class="flex justify-between mt-1 font-bold text-lg">
            <p>Total</p>
            <p id="detailTotal" class="text-red-600">$16.90</p>
          </div>
        </div>
      </div>
      
      <div class="p-6 border-t border-gray-200 flex justify-end">
        <button id="closeOrderDetailBtn" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">Close</button>
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
      },
      {
        id: 7,
        name: 'Cold Brew',
        category: 'Cold Coffee',
        price: 5.00,
        image: 'https://images.unsplash.com/photo-1551029506-0807df4e2031?w=300&h=200&fit=crop',
        description: 'Smooth cold brewed coffee'
      },
      {
        id: 8,
        name: 'Chai Latte',
        category: 'Hot Tea',
        price: 4.75,
        image: 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=300&h=200&fit=crop',
        description: 'Spiced tea with steamed milk'
      },
      {
        id: 9,
        name: 'Blueberry Muffin',
        category: 'Bakery',
        price: 3.75,
        image: 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=300&h=200&fit=crop',
        description: 'Moist muffin with fresh blueberries'
      }
    ];

    const orderHistory = [
      {
        id: 'ORD-1001',
        date: '2023-06-15',
        status: 'delivered',
        items: [
          { id: 1, name: 'Espresso', quantity: 2, price: 4.50 },
          { id: 5, name: 'Chocolate Croissant', quantity: 1, price: 4.25 }
        ],
        subtotal: 13.25,
        tax: 1.19,
        total: 14.44
      },
      {
        id: 'ORD-1002',
        date: '2023-06-10',
        status: 'ready',
        items: [
          { id: 3, name: 'Iced Latte', quantity: 1, price: 5.75 },
          { id: 6, name: 'Avocado Toast', quantity: 1, price: 7.50 }
        ],
        subtotal: 13.25,
        tax: 1.19,
        total: 14.44
      },
      {
        id: 'ORD-1003',
        date: '2023-06-05',
        status: 'preparing',
        items: [
          { id: 2, name: 'Cappuccino', quantity: 1, price: 5.25 },
          { id: 4, name: 'Green Tea', quantity: 1, price: 3.50 }
        ],
        subtotal: 8.75,
        tax: 0.79,
        total: 9.54
      }
    ];

    let userProfile = {
      name: 'Hitori Gotoh',
      email: 'hitori@example.com',
      phone: '+1 (555) 123-4567',
      image: 'hitori.jpeg',
      points: 350,
      favorites: [1, 3, 6], 
      orderCount: 12
    };

    let cart = [];
    let cartCount = 0;
    let cartTotal = 0;

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
    const viewOrdersBtn = document.getElementById('viewOrdersBtn');
    const viewFavoritesBtn = document.getElementById('viewFavoritesBtn');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const orderDetailModal = document.getElementById('orderDetailModal');
    const closeOrderDetail = document.getElementById('closeOrderDetail');
    const closeOrderDetailBtn = document.getElementById('closeOrderDetailBtn');
    const favoritesGrid = document.getElementById('favoritesGrid');
    const orderHistoryDiv = document.getElementById('orderHistory');
    const recentOrdersDiv = document.getElementById('recentOrders');
    const tabContents = document.querySelectorAll('.tab-content');
    const tabLinks = document.querySelectorAll('.sidebar-link');
    const menuFilters = document.querySelectorAll('.menu-filter');
    const ordersCountEl = document.getElementById('ordersCount');
    const favoritesCountEl = document.getElementById('favoritesCount');
    const totalOrdersCountEl = document.getElementById('totalOrdersCount');
    const favoriteDrinksCountEl = document.getElementById('favoriteDrinksCount');
    const pointsEarnedEl = document.getElementById('pointsEarned');

    function initDashboard() {
      renderMenu();
      renderFavorites();
      renderOrderHistory();
      renderRecentOrders();
      updateProfile();
      updateStats();
      
      cartToggle.addEventListener('click', toggleCart);
      closeCart.addEventListener('click', toggleCart);
      profileToggle.addEventListener('click', toggleProfileDropdown);
      editProfileBtn.addEventListener('click', openProfileModal);
      viewOrdersBtn.addEventListener('click', () => switchTab('orders'));
      viewFavoritesBtn.addEventListener('click', () => switchTab('favorites'));
      checkoutBtn.addEventListener('click', checkout);
      closeOrderDetail.addEventListener('click', closeOrderDetailModal);
      closeOrderDetailBtn.addEventListener('click', closeOrderDetailModal);
      
      document.getElementById('cancelEdit').addEventListener('click', closeProfileModal);
      document.getElementById('saveProfile').addEventListener('click', saveProfileChanges);
      document.getElementById('changePhotoBtn').addEventListener('click', () => {
        document.getElementById('photoInput').click();
      });
      document.getElementById('photoInput').addEventListener('change', handlePhotoChange);
      
      tabLinks.forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const tabId = link.getAttribute('data-tab');
          switchTab(tabId);
        });
      });
      
      menuFilters.forEach(filter => {
        filter.addEventListener('click', () => {
          const category = filter.getAttribute('data-category');
          filterMenu(category);
          
          menuFilters.forEach(f => f.classList.remove('bg-red-700', 'text-white'));
          menuFilters.forEach(f => f.classList.add('bg-gray-200', 'hover:bg-gray-300'));
          filter.classList.remove('bg-gray-200', 'hover:bg-gray-300');
          filter.classList.add('bg-red-700', 'text-white');
        });
      });
      
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
        const isFavorite = userProfile.favorites.includes(item.id);
        const menuItem = document.createElement('div');
        menuItem.className = 'menu-item dashboard-card rounded-xl overflow-hidden cursor-pointer';
        menuItem.innerHTML = `
          <div class="relative">
            <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
            <button onclick="toggleFavorite(${item.id}, event)" class="absolute top-2 right-2 p-2 rounded-full bg-white/80 hover:bg-white transition-colors ${isFavorite ? 'text-red-600' : 'text-gray-400'}">
              <i class="fas fa-heart ${isFavorite ? 'active' : ''}"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="flex justify-between items-start mb-2">
              <div>
                <h4 class="text-lg font-semibold text-gray-900">${item.name}</h4>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">${item.category}</span>
              </div>
              <span class="text-lg font-bold text-red-600">$${item.price.toFixed(2)}</span>
            </div>
            <p class="text-gray-600 text-sm mb-3">${item.description}</p>
            <button onclick="addToCart(${item.id}, event)" class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition-colors duration-300 flex items-center justify-center space-x-2">
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

    function filterMenu(category) {
      if (category === 'all') {
        renderMenu();
        return;
      }
      
      const filteredMenu = menuData.filter(item => item.category === category);
      menuGrid.innerHTML = '';
      
      filteredMenu.forEach(item => {
        const isFavorite = userProfile.favorites.includes(item.id);
        const menuItem = document.createElement('div');
        menuItem.className = 'menu-item dashboard-card rounded-xl overflow-hidden cursor-pointer';
        menuItem.innerHTML = `
          <div class="relative">
            <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
            <button onclick="toggleFavorite(${item.id}, event)" class="absolute top-2 right-2 p-2 rounded-full bg-white/80 hover:bg-white transition-colors ${isFavorite ? 'text-red-600' : 'text-gray-400'}">
              <i class="fas fa-heart ${isFavorite ? 'active' : ''}"></i>
            </button>
          </div>
          <div class="p-4">
            <div class="flex justify-between items-start mb-2">
              <div>
                <h4 class="text-lg font-semibold text-gray-900">${item.name}</h4>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">${item.category}</span>
              </div>
              <span class="text-lg font-bold text-red-600">$${item.price.toFixed(2)}</span>
            </div>
            <p class="text-gray-600 text-sm mb-3">${item.description}</p>
            <button onclick="addToCart(${item.id}, event)" class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition-colors duration-300 flex items-center justify-center space-x-2">
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

    function renderFavorites() {
      favoritesGrid.innerHTML = '';
      
      if (userProfile.favorites.length === 0) {
        favoritesGrid.innerHTML = `
          <div class="col-span-3 text-center py-12">
            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h4 class="mt-4 text-lg font-medium text-gray-900">No favorites yet</h4>
            <p class="mt-1 text-gray-500">Add items to your favorites from the menu</p>
            <button onclick="switchTab('menu')" class="mt-4 px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">
              Browse Menu
            </button>
          </div>
        `;
        return;
      }
      
      userProfile.favorites.forEach(favId => {
        const item = menuData.find(item => item.id === favId);
        if (item) {
          const favoriteItem = document.createElement('div');
          favoriteItem.className = 'menu-item dashboard-card rounded-xl overflow-hidden cursor-pointer';
          favoriteItem.innerHTML = `
            <div class="relative">
              <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
              <button onclick="toggleFavorite(${item.id}, event)" class="absolute top-2 right-2 p-2 rounded-full bg-white/80 hover:bg-white transition-colors text-red-600">
                <i class="fas fa-heart active"></i>
              </button>
            </div>
            <div class="p-4">
              <div class="flex justify-between items-start mb-2">
                <div>
                  <h4 class="text-lg font-semibold text-gray-900">${item.name}</h4>
                  <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">${item.category}</span>
                </div>
                <span class="text-lg font-bold text-red-600">$${item.price.toFixed(2)}</span>
              </div>
              <p class="text-gray-600 text-sm mb-3">${item.description}</p>
              <button onclick="addToCart(${item.id}, event)" class="w-full bg-red-700 text-white py-2 px-4 rounded-lg hover:bg-red-800 transition-colors duration-300 flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span>Add to Cart</span>
              </button>
            </div>
          `;
          favoritesGrid.appendChild(favoriteItem);
        }
      });
    }

    // Render order history
    function renderOrderHistory() {
      orderHistoryDiv.innerHTML = '';
      
      if (orderHistory.length === 0) {
        orderHistoryDiv.innerHTML = `
          <div class="text-center py-12">
            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <h4 class="mt-4 text-lg font-medium text-gray-900">No orders yet</h4>
            <p class="mt-1 text-gray-500">Your order history will appear here</p>
          </div>
        `;
        return;
      }
      
      orderHistory.forEach(order => {
        const orderDate = new Date(order.date);
        const formattedDate = orderDate.toLocaleDateString('en-US', { 
          year: 'numeric', 
          month: 'short', 
          day: 'numeric' 
        });
        
        const orderItem = document.createElement('div');
        orderItem.className = 'p-4 hover:bg-gray-50 cursor-pointer';
        orderItem.innerHTML = `
          <div class="flex items-center justify-between">
            <div>
              <h4 class="font-medium text-gray-900">Order #${order.id}</h4>
              <p class="text-sm text-gray-500">${formattedDate}</p>
            </div>
            <div class="flex items-center space-x-4">
              <span class="order-status status-${order.status}">
                ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}
              </span>
              <span class="font-medium">$${order.total.toFixed(2)}</span>
              <button onclick="viewOrderDetails('${order.id}')" class="text-red-600 hover:text-red-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
          </div>
        `;
        orderHistoryDiv.appendChild(orderItem);
      });
    }

    function renderRecentOrders() {
      recentOrdersDiv.innerHTML = '';
      
      const recentOrders = orderHistory.slice(0, 3); 
      if (recentOrders.length === 0) {
        recentOrdersDiv.innerHTML = `
          <div class="p-4 text-center text-gray-500">
            No recent orders
          </div>
        `;
        return;
      }
      
      recentOrders.forEach(order => {
        const orderDate = new Date(order.date);
        const formattedDate = orderDate.toLocaleDateString('en-US', { 
          month: 'short', 
          day: 'numeric' 
        });
        
        const orderItem = document.createElement('div');
        orderItem.className = 'p-4 hover:bg-gray-50 cursor-pointer';
        orderItem.innerHTML = `
          <div class="flex items-center justify-between">
            <div>
              <h4 class="font-medium text-gray-900">Order #${order.id}</h4>
              <p class="text-sm text-gray-500">${formattedDate}</p>
            </div>
            <div class="flex items-center space-x-4">
              <span class="order-status status-${order.status}">
                ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}
              </span>
              <span class="font-medium">$${order.total.toFixed(2)}</span>
              <button onclick="viewOrderDetails('${order.id}')" class="text-red-600 hover:text-red-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
          </div>
        `;
        recentOrdersDiv.appendChild(orderItem);
      });
    }

    function viewOrderDetails(orderId) {
      const order = orderHistory.find(o => o.id === orderId);
      if (!order) return;
      
      const orderDate = new Date(order.date);
      const formattedDate = orderDate.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
      });
      
      document.getElementById('detailOrderId').textContent = `#${order.id}`;
      document.getElementById('detailOrderDate').textContent = formattedDate;
      
      let statusText = order.status.charAt(0).toUpperCase() + order.status.slice(1);
      let statusClass = '';
      switch(order.status) {
        case 'preparing':
          statusClass = 'status-preparing';
          break;
        case 'ready':
          statusClass = 'status-ready';
          break;
        case 'delivered':
          statusClass = 'status-delivered';
          break;
        case 'cancelled':
          statusClass = 'status-cancelled';
          break;
      }
      
      document.getElementById('detailOrderStatus').innerHTML = `
        <span class="order-status ${statusClass}">${statusText}</span>
      `;
      
      const itemsContainer = document.getElementById('detailOrderItems');
      itemsContainer.innerHTML = '';
      
      order.items.forEach(item => {
        const itemEl = document.createElement('div');
        itemEl.className = 'flex justify-between';
        itemEl.innerHTML = `
          <div>
            <p class="font-medium">${item.name}</p>
            <p class="text-sm text-gray-500">${item.quantity} x $${item.price.toFixed(2)}</p>
          </div>
          <p class="font-medium">$${(item.quantity * item.price).toFixed(2)}</p>
        `;
        itemsContainer.appendChild(itemEl);
      });
      
      document.getElementById('detailSubtotal').textContent = `$${order.subtotal.toFixed(2)}`;
      document.getElementById('detailTax').textContent = `$${order.tax.toFixed(2)}`;
      document.getElementById('detailTotal').textContent = `$${order.total.toFixed(2)}`;
      
      orderDetailModal.classList.remove('hidden');
    }

    function closeOrderDetailModal() {
      orderDetailModal.classList.add('hidden');
    }

    function addToCart(itemId, event) {
      event.stopPropagation();
      const item = menuData.find(item => item.id === itemId);
      const existingItem = cart.find(cartItem => cartItem.id === itemId);
      
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({...item, quantity: 1});
      }
      
      updateCart();
      
      const button = event.target.closest('button');
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
      
      cartItems.innerHTML = '';
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

    function toggleProfileDropdown() {
      profileDropdown.classList.toggle('hidden');
    }


    function openProfileModal() {
      document.getElementById('usernameInput').value = userProfile.name;
      document.getElementById('emailInput').value = userProfile.email;
      document.getElementById('phoneInput').value = userProfile.phone;
      document.getElementById('modalProfileImage').src = userProfile.image;
      profileDropdown.classList.add('hidden');
      profileModal.classList.remove('hidden');
    }

    function closeProfileModal() {
      profileModal.classList.add('hidden');
    }

    function saveProfileChanges() {
      const newName = document.getElementById('usernameInput').value;
      const newEmail = document.getElementById('emailInput').value;
      const newPhone = document.getElementById('phoneInput').value;
      
      if (newName && newEmail) {
        userProfile.name = newName;
        userProfile.email = newEmail;
        userProfile.phone = newPhone;
        
        updateProfile();
        closeProfileModal();
        
        alert('Profile updated successfully!');
      } else {
        alert('Please fill in all required fields');
      }
    }

    function handlePhotoChange(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          userProfile.image = event.target.result;
          document.getElementById('modalProfileImage').src = event.target.result;
          updateProfile();
        };
        reader.readAsDataURL(file);
      }
    }

    function updateProfile() {
      document.getElementById('profileName').textContent = userProfile.name;
      document.getElementById('welcomeName').textContent = userProfile.name;
      document.getElementById('profileImage').src = userProfile.image;
    }

    function updateStats() {
      totalOrdersCountEl.textContent = userProfile.orderCount;
      pointsEarnedEl.textContent = userProfile.points;
      favoriteDrinksCountEl.textContent = userProfile.favorites.length;
      ordersCountEl.textContent = orderHistory.length;
      favoritesCountEl.textContent = userProfile.favorites.length;
    }

    function toggleFavorite(itemId, event) {
      event.stopPropagation();
      const index = userProfile.favorites.indexOf(itemId);
      
      if (index === -1) {
        userProfile.favorites.push(itemId);
      } else {
        userProfile.favorites.splice(index, 1);
      }
      
      const heartIcon = event.target.closest('button').querySelector('i');
      heartIcon.classList.toggle('active');
      heartIcon.classList.toggle('text-red-600');
      heartIcon.classList.toggle('text-gray-400');
      
      updateStats();
      
      if (document.getElementById('favorites').classList.contains('active')) {
        renderFavorites();
      }
    }

    function switchTab(tabId) {
      tabContents.forEach(content => {
        content.classList.remove('active');
      });
      
      document.getElementById(tabId).classList.add('active');
      
      tabLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('data-tab') === tabId) {
          link.classList.add('active');
        }
      });
      
      profileDropdown.classList.add('hidden');
    }

    function checkout() {
      if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
      }
      
      const orderId = 'ORD-' + Math.floor(1000 + Math.random() * 9000);
      const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      const tax = subtotal * 0.1; // 10% tax
      const total = subtotal + tax;
      
      const newOrder = {
        id: orderId,
        date: new Date().toISOString().split('T')[0],
        status: 'preparing',
        items: cart.map(item => ({
          id: item.id,
          name: item.name,
          quantity: item.quantity,
          price: item.price
        })),
        subtotal: subtotal,
        tax: tax,
        total: total
      };
      
      
      orderHistory.unshift(newOrder);
      
      userProfile.orderCount += 1;
      userProfile.points += Math.floor(total);
      
      cart = [];
      updateCart();
      updateStats();
      renderOrderHistory();
      renderRecentOrders();
      
      alert(`Order #${orderId} placed successfully! You earned ${Math.floor(total)} points.`);
      
      cartSidebar.classList.add('translate-x-full');
    }

    document.addEventListener('DOMContentLoaded', initDashboard);
  </script>
</body>
</html>