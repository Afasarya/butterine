<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butterine - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#D43C06',
                        dark: '#111111',
                        light: '#F5F5F5',
                    },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="font-inter bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="flex flex-col md:flex-row max-w-6xl w-full bg-white rounded-2xl overflow-hidden shadow-xl">
        <!-- Left Column - Image with Text Overlay -->
        <div class="w-full md:w-1/2 relative h-96 md:h-auto">
            <img src="{{ asset('images/login-1.png') }}" alt="Delicious Brownies" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-end p-10">
                <h1 class="text-white text-4xl font-bold mb-2 text-shadow">Every bite, Its Taste a love</h1>
                <p class="text-white text-2xl text-shadow">Butterine</p>
            </div>
        </div>
        
        <!-- Right Column - Login Form -->
        <div class="w-full md:w-1/2 py-8 px-6 md:px-12 flex flex-col justify-center">
            <div class="flex justify-center mb-4">
                <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                    <span class="text-white font-bold text-lg">B</span>
                </div>
            </div>
            
            <div class="text-center mb-8">
                <p class="text-gray-700 mb-1">Welcome to Butterine</p>
                <h2 class="text-3xl font-bold">Login</h2>
            </div>
            
            <p class="text-gray-600 mb-8 text-center">
                Welcome to Butterine 🍰✨ Log in now to place orders, track your favorites, and enjoy sweet rewards
            </p>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">
                        {{ __('Whoops! Something went wrong.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your Email" 
                        class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        required
                        autofocus
                    >
                </div>
                
                <div class="mb-8">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="Enter your Password" 
                            class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            required
                        >
                        <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm text-primary hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-primary text-white py-3 rounded-full font-medium hover:bg-primary/90 transition duration-300"
                >
                    Login
                </button>
                
                @if (Route::has('register'))
                <div class="text-center mt-6">
                    <p class="text-gray-600">
                        Don't Have an Account? <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">Sign Up</a>
                    </p>
                </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.far.fa-eye');
            const password = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                // Toggle type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle eye icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>