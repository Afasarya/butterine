<!-- resources/views/categories-show.blade.php -->
@extends('layouts.app')

@section('title', $category->name)

@section('content')
<section class="py-8 px-4 md:px-12 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="flex items-center mb-6">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary">Home</a>
        <span class="mx-2">/</span>
        <span class="text-primary">{{ $category->name }}</span>
    </div>

    <!-- Category Header -->
    <div class="mb-8 flex items-center">
        <div class="w-16 h-16 rounded-full bg-red-200 flex items-center justify-center mr-4">
            @if($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded-full">
            @else
            <img src="https://via.placeholder.com/60" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded-full">
            @endif
        </div>
        <div>
            <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-gray-600">{{ $category->description }}</p>
            @endif
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
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
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-cookie-bite text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-500">No products found in this category</h3>
                <p class="text-gray-400 mt-2">Check back soon for new items!</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</section>
@endsection