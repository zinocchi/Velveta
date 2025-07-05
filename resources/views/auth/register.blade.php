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
  <header class="fixed top-0 left-0 w-full bg-white text-black py-3 px-6 shadow-md z-50 flex justify-between items-center">
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
        


        
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf
          
          <div class="pb-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold mb-6 text-gray-700 montserrat">Personal Information</h3>
            
            <div>
              <label for="name" class="block text-sm font-medium mb-2 text-gray-700">* Full Name</label>
              <input 
                type="text" 
                id="name" 
                name="name" 
                required 
                value="{{ old('name') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                placeholder="Enter your full name"
              />
            </div>
            
            <div class="mt-5">
              <label for="email" class="block text-sm font-medium mb-2 text-gray-700">* Email Address</label>
              <input 
                type="email" 
                id="email" 
                name="email" 
                required 
                value="{{ old('email') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                placeholder="Enter your email address"
              />
            </div>
          </div>
          
          <div class="pt-2 pb-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold mb-6 text-gray-700 montserrat">Account Information</h3>
            
            <div>
              <label for="username" class="block text-sm font-medium mb-2 text-gray-700">* Username</label>
              <input 
                type="text" 
                id="username" 
                name="username" 
                required 
                value="{{ old('username') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                placeholder="Choose a username"
              />
              <p class="text-xs text-gray-500 mt-1">Username must be 4-20 characters</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
              <div>
                <label for="password" class="block text-sm font-medium mb-2 text-gray-700">* Password</label>
                <div class="relative">
                  <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                    placeholder="Create a password"
                  />
                </div>
              </div>
              
              <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-2 text-gray-700">* Confirm Password</label>
                <div class="relative">
                  <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                    placeholder="Confirm your password"
                  />
                </div>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.</p>
          </div>
          
          <div class="pt-2">
            <h3 class="text-lg font-semibold mb-6 text-gray-700 montserrat">Preferences</h3>
            
            <div class="flex items-start mb-4">
              <div class="flex items-center h-5">
                <input 
                  type="checkbox" 
                  id="newsletter" 
                  name="newsletter"
                  class="w-5 h-5 text-velveta rounded focus:ring-red-300 border-gray-300"
                  {{ old('newsletter', true) ? 'checked' : '' }}
                />
              </div>
              <div class="ml-3 text-sm">
                <label for="newsletter" class="text-gray-700">Subscribe to our newsletter</label>
                <p class="text-gray-500">Get updates on new products, special offers, and more.</p>
              </div>
            </div>
            
            <div class="flex items-start mt-6">
              <div class="flex items-center h-5">
                <input 
                  type="checkbox" 
                  id="terms" 
                  name="terms"
                  class="w-5 h-5 text-velveta rounded focus:ring-red-300 border-gray-300"
                  required
                />
              </div>
              <div class="ml-3 text-sm">
                <label for="terms" class="text-gray-700">I agree to the <a href="#" class="text-velveta hover:underline">Terms of Service</a> and <a href="#" class="text-velveta hover:underline">Privacy Policy</a></label>
              </div>
            </div>
          </div>
          
          <div class="pt-8 flex justify-end space-x-4">
            <a 
              href="login" 
              class="px-6 py-3 bg-white text-velveta font-medium rounded-full shadow-sm border border-velveta hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transition duration-300"
            >
              Back to Login
            </a>
            <button 
              type="submit" 
              class="px-8 py-3 bg-velveta text-white font-medium rounded-full shadow-md hover-bg-velveta-dark focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transition duration-300 text-base"
            >
              Create Account
            </button>
          </div>
        </form>
      </div>

      <div class="text-center mt-8">
        <p class="text-gray-600">Already have an account? 
          <a href="login" class="text-velveta font-medium hover:text-red-800 transition duration-200">Sign in here</a>
        </p>
      </div>
    </div>
  </main>

  <footer class="text-center text-gray-500 text-sm pb-8">
    <p>© {{ date('Y') }} Velveta. All rights reserved.</p>
  </footer>
</body>
</html>