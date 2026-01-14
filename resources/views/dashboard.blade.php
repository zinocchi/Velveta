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
              @if(Auth::check() && Auth::user()->photo)
                <img id="profileImage" src="{{ Storage::disk('public')->url(Auth::user()->photo) }}" alt="Profile" class="w-8 h-8 rounded-full profile-avatar object-cover">
              @else
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold profile-avatar">
                  {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
              @endif
              <span id="profileName" class="text-sm font-medium text-gray-900 hidden md:inline">{{ Auth::user()->name }}</span>
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
                <form method="POST" action="{{ route('logout') }}" class="border-t">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                  </button>
                </form>
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
          <h2 class="text-3xl font-bold text-gray-900 mb-2 font-montserrat">Welcome, <span id="welcomeName">{{ Auth::user()->name }}</span>!</h2>
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

      <!-- Tab konten lainnya tetap sama -->
      <div id="menu" class="tab-content">
        <!-- ... konten menu ... -->
      </div>

      <div id="orders" class="tab-content">
        <!-- ... konten orders ... -->
      </div>

      <div id="favorites" class="tab-content">
        <!-- ... konten favorites ... -->
      </div>
    </main>
  </div>

  <!-- Modal Edit Profile -->
  <div id="profileModal" class="fixed inset-0 modal hidden z-50 flex items-center justify-center p-4">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md">
      <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Profile</h3>
      </div>

      <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-6">
          <div class="space-y-4">
            <div class="text-center">
              @if(Auth::check() && Auth::user()->photo)
                <img id="modalProfileImage" src="{{ Storage::disk('public')->url(Auth::user()->photo) }}" alt="Profile" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
              @else
                <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold text-2xl mx-auto mb-4">
                  {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
              @endif
              <button type="button" id="changePhotoBtn" class="text-red-600 hover:text-red-700 font-medium text-sm">
                <i class="fas fa-camera mr-1"></i>Change Photo
              </button>
              <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
              <input type="text" id="nameInput" name="name" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
              <input type="text" id="usernameInput" name="username" value="{{ Auth::user()->username }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input type="email" id="emailInput" value="{{ Auth::user()->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" disabled>
              <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
            </div>
          </div>
        </div>

        <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
          <button type="button" id="cancelEdit" class="px-4 py-2 text-gray-700 hover:text-gray-900">Cancel</button>
          <button type="submit" id="saveProfile" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors duration-300">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal lainnya tetap sama -->
  <div id="cartSidebar" class="fixed right-0 top-0 h-full w-80 bg-white shadow-xl transform translate-x-full transition-transform duration-300 z-50">
    <!-- ... konten cart ... -->
  </div>

  <div id="orderDetailModal" class="fixed inset-0 modal hidden z-50 flex items-center justify-center p-4">
    <!-- ... konten order detail ... -->
  </div>

  <script>
    // Inisialisasi userProfile dengan data dari Laravel
    let userProfile = {
      name: "{{ Auth::user()->name }}",
      username: "{{ Auth::user()->username }}",
      email: "{{ Auth::user()->email }}",
      photo: "{{ Auth::user()->photo ? Storage::disk('public')->url(Auth::user()->photo) : '' }}",
      points: 350,
      favorites: [1, 3, 6],
      orderCount: 12
    };

    // Fungsi untuk update profile picture preview
    function handlePhotoChange(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          // Update preview di modal
          document.getElementById('modalProfileImage').src = event.target.result;

          // Update preview di header
          document.getElementById('profileImage').src = event.target.result;

          // Simpan file untuk upload
          userProfile.tempPhoto = file;
        };
        reader.readAsDataURL(file);
      }
    }

    // Fungsi untuk submit form profile
    document.getElementById('profileForm').addEventListener('submit', function(e) {
      // Form akan di-submit secara normal ke Laravel backend
      // Tidak perlu handle dengan JavaScript karena sudah ada form submission
    });

    // Update fungsi initDashboard untuk menggunakan data real
    function initDashboard() {
      // Update profile info
      updateProfile();

      // Event listener untuk photo input
      document.getElementById('changePhotoBtn').addEventListener('click', () => {
        document.getElementById('photoInput').click();
      });
      document.getElementById('photoInput').addEventListener('change', handlePhotoChange);

      // ... kode JavaScript lainnya tetap sama ...
    }

    // Fungsi updateProfile yang menggunakan data dari Laravel
    function updateProfile() {
      document.getElementById('profileName').textContent = userProfile.name;
      document.getElementById('welcomeName').textContent = userProfile.name;

      // Update profile image jika ada
      if (userProfile.photo) {
        document.getElementById('profileImage').src = userProfile.photo;
        document.getElementById('modalProfileImage').src = userProfile.photo;
      }
    }

    // ... kode JavaScript lainnya tetap sama ...

    document.addEventListener('DOMContentLoaded', initDashboard);
  </script>
</body>
</html>
    