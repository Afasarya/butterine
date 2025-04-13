<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butterine - @yield('title', 'Admin Panel')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#D43C06',
                        secondary: '#F9F4EE',
                        pending: '#FEF0EC',
                        pending_text: '#FD7955',
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
            background-color: #F9F4EE;
        }
        
        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }
        
        .main-content {
            transition: all 0.3s;
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                width: 0;
                left: -250px;
            }
            
            .sidebar.active {
                width: 250px;
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    @yield('styles')
</head>
<body class="font-inter bg-secondary">
    <!-- Sidebar -->
    <div class="sidebar fixed top-0 left-0 h-full bg-white shadow-md z-40 overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center mb-10">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white mr-2">
                    <span class="text-sm font-bold">B</span>
                </div>
                <h1 class="text-xl font-semibold">butterine</h1>
            </div>
            
            <nav>
                <ul class="space-y-6">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center {{ request()->routeIs('admin.dashboard') ? 'text-primary font-medium' : 'text-gray-600 hover:text-primary transition' }}">
                            <div class="w-5 mr-3">
                                <i class="fas fa-home"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center {{ request()->routeIs('admin.categories.*') ? 'text-primary font-medium' : 'text-gray-600 hover:text-primary transition' }}">
                            <div class="w-5 mr-3">
                                <i class="fas fa-tags"></i>
                            </div>
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center {{ request()->routeIs('admin.products.*') ? 'text-primary font-medium' : 'text-gray-600 hover:text-primary transition' }}">
                            <div class="w-5 mr-3">
                                <i class="fas fa-cookie"></i>
                            </div>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center {{ request()->routeIs('admin.orders.*') ? 'text-primary font-medium' : 'text-gray-600 hover:text-primary transition' }}">
                            <div class="w-5 mr-3">
                                <i class="far fa-list-alt"></i>
                            </div>
                            Order List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center {{ request()->routeIs('profile.*') ? 'text-primary font-medium' : 'text-gray-600 hover:text-primary transition' }}">
                            <div class="w-5 mr-3">
                                <i class="fas fa-cog"></i>
                            </div>
                            Setting
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="flex items-center text-gray-600 hover:text-primary transition" 
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="w-5 mr-3">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content min-h-screen overflow-hidden pb-8">
        <!-- Header -->
        <header class="bg-white py-4 px-6 flex justify-between items-center shadow-sm">
            <div>
                <h2 class="font-semibold text-lg">Hi, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-500 text-sm">Let's check your store today</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search..."
                        class="py-2 pl-8 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-60"
                    >
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <div class="mr-3 text-right">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">Admin</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-pink-500 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" alt="Profile" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Page Content -->
        <div class="mx-6 my-6">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Create menu button for mobile if it doesn't exist
            const header = document.querySelector('header');
            if (header && window.innerWidth < 1024) {
                const menuButton = document.createElement('button');
                menuButton.className = 'md:hidden text-gray-700 mr-4';
                menuButton.innerHTML = '<i class="fas fa-bars text-xl"></i>';
                
                const headerContent = header.querySelector('div:first-child');
                header.insertBefore(menuButton, headerContent);
                
                menuButton.addEventListener('click', function() {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.classList.toggle('active');
                });
            }
            
            // Handle window resize
            window.addEventListener('resize', function() {
                const sidebar = document.querySelector('.sidebar');
                if (window.innerWidth >= 1024) {
                    sidebar.style.left = '0';
                } else {
                    if (!sidebar.classList.contains('active')) {
                        sidebar.style.left = '-250px';
                    }
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>