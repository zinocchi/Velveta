<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Velveta</title>
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
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <header class="fixed top-0 left-0 w-full bg-white text-black py-3 px-6 shadow-md z-50 flex justify-between items-center">
    <div class="logo">
      <img src="velveta.png" alt="Logo" class="h-14">
    </div>
    <div class="nav-right flex gap-6 items-center">
    </div>      
  </header>

  <main class="pt-32 pb-16 px-5 flex justify-center">
    <div class="w-full max-w-md">
      <h2 class="text-2xl font-bold text-center mb-10 montserrat text-gray-800">Log in to Your Account</h2>
      
      <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <p class="text-sm text-gray-500 mb-8">* indicates required field</p>
        
        <form method="POST"space-y-6">
          <div>
            <label for="username" class="block text-sm font-medium mb-2 text-gray-700">* Username or email address</label>
            <input 
              type="text" 
              id="username" 
              name="username" 
              required 
              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
              placeholder="Enter your username or email"
            />
          </div>
          
          <div>
            <label for="password" class="block text-sm font-medium mb-2 text-gray-700">* Password</label>
            <div class="relative">
              <input 
                type="password" 
                id="password" 
                name="password" 
                required 
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus-ring-velveta focus-border-velveta transition duration-200"
                placeholder="Enter your password"
              />
            </div>
          </div>

          <div class="flex items-center pt-2">
            <input 
              type="checkbox" 
              id="keep-signed-in" 
              class="w-5 h-5 text-velveta rounded focus:ring-red-300 border-gray-300"
            />
            <label for="keep-signed-in" class="ml-3 text-gray-700">
              Keep me signed in
            </label>
          </div>

          <div class="space-y-2 pt-2">
            <a href="#" class="block text-sm text-velveta hover:text-red-800 transition duration-200">Forgot your username?</a>
            <a href="#" class="block text-sm text-velveta hover:text-red-800 transition duration-200">Forgot your password?</a>
          </div>
          
          <div class="pt-6 flex justify-end">
            <button 
              type="submit" 
              class="px-8 py-3 bg-velveta text-white font-medium rounded-full shadow-md hover-bg-velveta-dark focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transition duration-300 text-base"
            >
              Sign in
            </button>
          </div>
        </form>
      </div>

      <div class="text-center mt-8">
        <p class="text-gray-600">Don't have an account? 
          <a href="#" class="text-velveta font-medium hover:text-red-800 transition duration-200">Register now</a>
        </p>
      </div>
    </div>
  </main>

  <footer class="text-center text-gray-500 text-sm pb-8">
    <p>© 2025 Velveta. All rights reserved.</p>
  </footer>
</body>
</html>