<!-- resources/views/product.blade.php -->
@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="py-12 px-4 md:px-12 max-w-7xl mx-auto">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                <img src="https://via.placeholder.com/600x400" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="md:w-1/2 p-8">
                <div class="uppercase tracking-wide text-sm text-primary font-semibold">{{ $product->category->name }}</div>
                <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                <div class="flex items-center mt-2">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($product->rating ?? 5))
                                <i class="fas fa-star text-yellow-400"></i>
                            @else
                                <i class="far fa-star text-yellow-400"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="ml-2 text-gray-600">{{ $product->sold_count }} sold</span>
                </div>
                <p class="mt-4 text-2xl font-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="mt-4 text-gray-600">{{ $product->description }}</p>
                
                <div class="mt-8">
                    <a href="https://api.whatsapp.com/send/?phone=085846695685&text&type=phone_number&app_absent=0" target="_blank" class="inline-block bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-primary/90 transition">
                        <i class="fab fa-whatsapp mr-2"></i> Order via WhatsApp
                    </a>
                    <a href="{{ route('home') }}#menu" class="inline-block ml-4 text-primary font-bold hover:underline">
                        Back to Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection