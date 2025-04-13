<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="py-8 px-4 md:px-12 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-8 md:mb-0">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                Every <span class="text-primary">Bite</span>, It's a Taste of <span class="text-primary">Love</span>
            </h1>
            <p class="text-gray-600 mb-8 max-w-lg">
                Where Every Bite Takes a Tale of Sweet Perfection and Heartfelt Baking.
            </p>
            <a href="#menu" class="bg-primary text-white px-6 py-3 rounded-md font-medium inline-block">
                Order Now
            </a>
        </div>
        <div class="md:w-1/2 relative">
            <img src="{{ asset('images/herosection.png') }}" alt="Delicious Pastry" class="rounded-lg w-full h-auto object-cover">
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="menu" class="py-12 px-4 md:px-12 max-w-7xl mx-auto">
    <div class="text-center mb-8">
        <span class="text-primary uppercase font-medium text-sm">CUSTOMER FAVORITES</span>
        <h2 class="text-3xl font-bold mt-2">Popular Categories</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($categories as $category)
        <div class="bg-white rounded-xl p-4 flex flex-col items-center shadow-sm hover:shadow-md transition">
            <div class="w-24 h-24 rounded-full bg-red-200 flex items-center justify-center mb-3">
                @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-16 h-16 object-cover rounded-full">
                @else
                <img src="https://via.placeholder.com/60" alt="{{ $category->name }}" class="w-16 h-16 object-cover rounded-full">
                @endif
            </div>
            <h3 class="font-medium">{{ $category->name }}</h3>
            <p class="text-xs text-gray-500">({{ $category->item_count }} items)</p>
        </div>
        @endforeach
    </div>
</section>

<!-- Special Dishes Section -->
<section class="py-12 px-4 md:px-12 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <span class="text-primary uppercase font-medium text-sm">SPECIAL DISHES</span>
            <h2 class="text-3xl font-bold mt-2">Standout Dishes<br>From Our Menu</h2>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($featuredProducts as $product)
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="relative mb-4">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-xl">
                @else
                <img src="https://via.placeholder.com/300x200" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-xl">
                @endif
                <a href="{{ route('product.show', $product->id) }}" class="absolute top-3 right-3 w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-white text-sm"></i>
                </a>
            </div>
            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
            <p class="text-xs text-gray-500 mb-4">{{ $product->description }}</p>
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-primary font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-star text-yellow-400 mr-1 text-sm"></i>
                    <span class="text-sm font-medium">{{ $product->rating ?? '4.9' }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-12 px-4 md:px-12 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 mb-8 md:mb-0">
            <span class="text-primary uppercase font-medium text-sm">OUR STORY & SERVICES</span>
            <h2 class="text-3xl font-bold mt-2 mb-6">Our Culinary Journey<br>And Services</h2>
            <p class="text-gray-600 mb-8 max-w-lg">
                Rooted in passion, we curate unforgettable dining experiences and offer exceptional services, blending culinary artistry with warm hospitality.
            </p>
            <a href="#menu" class="bg-primary text-white px-6 py-3 rounded-md font-medium inline-block">
                Explore
            </a>
        </div>
        <div class="md:w-1/2 grid grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-utensils text-primary"></i>
                </div>
                <h3 class="font-semibold mb-2">CATERING</h3>
                <p class="text-sm text-gray-500">Delight your guests with our flavors and exceptional service.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-truck text-primary"></i>
                </div>
                <h3 class="font-semibold mb-2">FAST DELIVERY</h3>
                <p class="text-sm text-gray-500">We deliver your order promptly to your destination.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shopping-cart text-primary"></i>
                </div>
                <h3 class="font-semibold mb-2">ONLINE ORDERING</h3>
                <p class="text-sm text-gray-500">Explore menu & order with ease using our online ordering.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-gift text-primary"></i>
                </div>
                <h3 class="font-semibold mb-2">GIFT CARDS</h3>
                <p class="text-sm text-gray-500">Give the gift of exceptional dining with Butterine Gift Cards.</p>
            </div>
        </div>
    </div>
</section>
@endsection