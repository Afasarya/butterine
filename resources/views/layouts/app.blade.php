<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butterine - @yield('title', 'Bakery & Brownies')</title>
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
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
    @yield('styles')
</head>
<body class="font-inter bg-gray-50">
    <!-- Header -->
    <header class="bg-white py-4 px-4 md:px-12 sticky top-0 z-50 shadow-sm">
        <nav class="flex justify-between items-center max-w-7xl mx-auto">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Butterine" class="w-12 h-12 mr-2 object-contain">
                </a>
                <ul class="hidden md:flex ml-10 space-x-8">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary' : 'text-gray-700 hover:text-primary transition' }} font-medium">Home</a></li>
                    <li><a href="#menu" class="text-gray-700 hover:text-primary transition font-medium">Menu</a></li>
                    <li><a href="#services" class="text-gray-700 hover:text-primary transition font-medium">Services</a></li>
                </ul>
            </div>
            <div class="flex items-center space-x-4">
                <button class="hidden md:block text-gray-700 hover:text-primary transition">
                    <i class="fas fa-search text-lg"></i>
                </button>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hidden md:block border border-primary text-primary px-4 py-2 rounded-md font-medium">Admin Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:block border border-primary text-primary px-4 py-2 rounded-md font-medium">Login</a>
                    @endauth
                @endif
                <button class="md:hidden text-gray-700" id="mobileMenuButton">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white absolute left-0 right-0 shadow-md z-50 mt-4 px-4 py-4">
            <ul class="space-y-4">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary' : 'text-gray-700' }} font-medium">Home</a></li>
                <li><a href="#menu" class="text-gray-700 font-medium">Menu</a></li>
                <li><a href="#services" class="text-gray-700 font-medium">Services</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ route('admin.dashboard') }}" class="text-primary font-medium">Admin Panel</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-primary font-medium">Login</a></li>
                    @endauth
                @endif
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-black text-white py-16 px-4 md:px-12 mt-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Butterine" class="w-10 h-10 mr-1">
                    </a>
                    <p class="text-gray-400 text-sm mb-6">
                        Savor the artistry where every dish is a culinary masterpiece.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-white hover:bg-primary transition">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-white hover:bg-primary transition">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold mb-6">Useful links</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">About us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">Events</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">Blogs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-6">Main Menu</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition text-sm">Home</a></li>
                        <li><a href="#menu" class="text-gray-400 hover:text-white transition text-sm">Menu</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-white transition text-sm">Services</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-6">Contact Us</h3>
                    <ul class="space-y-3">
                        <li class="text-gray-400 text-sm">butterine@gmail.com</li>
                        <li class="text-gray-400 text-sm">+62 812 3456 7890</li>
                        <li class="text-gray-400 text-sm">Social media</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-6 text-center md:text-right">
                <p class="text-gray-400 text-xs">Copyright © {{ date('Y') }} Butterine | All rights reserved</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>