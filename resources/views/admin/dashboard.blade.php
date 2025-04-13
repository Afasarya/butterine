@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    .donut-chart {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: conic-gradient(
            #D43C06 0% 64%,
            #FD7955 64% 100%
        );
        position: relative;
    }
    
    .donut-chart::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 50%;
    }
    
    .donut-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        font-weight: bold;
        font-size: 24px;
        color: #333;
    }
    
    .kurva-chart {
        height: 120px;
        position: relative;
        margin-top: 20px;
    }
    
    .kurva-line {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        fill: none;
        stroke: #D43C06;
        stroke-width: 3;
    }
    
    .kurva-highlight {
        position: absolute;
        top: 38px;
        right: 88px;
        width: 30px;
        height: 24px;
        background-color: #D43C06;
        color: white;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<!-- Hero Banner -->
<div class="mx-6 my-6 bg-white rounded-xl overflow-hidden relative shadow-sm">
    <!-- Full background image -->
    <div class="absolute inset-0 w-full h-full z-0">
        <img src="{{ asset('images/header-admin.png') }}" alt="Background" class="w-full h-full object-cover">
        <!-- Optional semi-transparent overlay for better text readability -->
        <div class="absolute inset-0 bg-black/10"></div>
    </div>
    
    <!-- Content -->
    <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center relative z-10">
        <div>
            <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs inline-flex items-center mb-3">
                <span class="mr-1">🔥</span>
                Deal of the weekend
            </div>
            <h1 class="text-3xl font-bold mb-2">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mb-4">Let's <span class="text-primary">check</span> the income!</p>
            <a href="{{ route('admin.orders.index') }}" class="bg-primary text-white px-5 py-2 rounded-md font-medium hover:bg-primary/90 transition inline-block">
                Check Income
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="mx-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Revenue by product -->
    <div class="bg-white p-5 rounded-xl shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-medium">Revenue by product</h3>
            <a href="{{ route('admin.products.index') }}" class="text-primary text-sm flex items-center">
                More <i class="fas fa-chevron-right ml-1 text-xs"></i>
            </a>
        </div>
        
        <div class="flex justify-center mb-4">
            <div class="donut-chart">
                <div class="donut-label">64%</div>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-2">
            @foreach($bestSellers as $index => $product)
            <div class="flex items-center">
                <span class="w-2 h-2 rounded-full {{ $index == 0 ? 'bg-primary' : ($index == 1 ? 'bg-orange-300' : ($index == 2 ? 'bg-pink-400' : 'bg-yellow-400')) }} mr-2"></span>
                <span class="text-sm">{{ $product->name }}</span>
                <span class="text-sm text-gray-500 ml-auto">{{ $product->sold_count }}</span>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Bestsellers -->
    <div class="bg-white p-5 rounded-xl shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-medium">Bestsellers</h3>
        </div>
        
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th class="text-left font-medium text-gray-500 pb-3">Product</th>
                    <th class="text-left font-medium text-gray-500 pb-3">Price <i class="fas fa-chevron-down ml-1 text-xs"></i></th>
                    <th class="text-left font-medium text-gray-500 pb-3">Sold <i class="fas fa-chevron-down ml-1 text-xs"></i></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($bestSellers as $product)
                <tr>
                    <td class="py-3 flex items-center">
                        <div class="w-8 h-8 rounded bg-orange-100 mr-2 flex items-center justify-center">
                            <div class="w-6 h-6 rounded bg-orange-500"></div>
                        </div>
                        <span>{{ $product->name }}</span>
                    </td>
                    <td class="py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-3">{{ $product->sold_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Kurva -->
    <div class="bg-white p-5 rounded-xl shadow-sm">
        <div class="mb-4">
            <h3 class="font-medium">Kurva</h3>
            <p class="text-sm text-gray-500">This week income</p>
        </div>
        
        <div class="kurva-chart">
            <!-- Simple curved line to represent chart -->
            <svg viewBox="0 0 300 100" class="kurva-line">
                <path d="M0,80 C50,90 100,20 150,50 C200,80 250,30 300,50" stroke="#D43C06" stroke-width="3" fill="none" />
            </svg>
            <div class="kurva-highlight">
                +8%
            </div>
        </div>
        
        <div class="grid grid-cols-7 gap-1 mt-4 text-center text-xs text-gray-500">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tues</div>
            <div>Wed</div>
            <div>Thurs</div>
            <div>Friday</div>
            <div>Sat</div>
        </div>
    </div>
</div>

<!-- Latest Orders -->
<div class="mx-6 mt-6 bg-white rounded-xl shadow-sm">
    <div class="p-5 flex justify-between items-center border-b border-gray-100">
        <h3 class="font-semibold">Latest Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-primary text-sm flex items-center">
            More <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left font-medium text-gray-500 border-b border-gray-100">
                    <th class="py-3 px-5">No</th>
                    <th class="py-3 px-5">Pict</th>
                    <th class="py-3 px-5">Full Name</th>
                    <th class="py-3 px-5">Order Item</th>
                    <th class="py-3 px-5">No. Telp</th>
                    <th class="py-3 px-5">Date</th>
                    <th class="py-3 px-5">Address</th>
                    <th class="py-3 px-5">Status <i class="fas fa-chevron-down ml-1 text-xs"></i></th>
                    <th class="py-3 px-5">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $index => $order)
                <tr class="border-b border-gray-100">
                    <td class="py-3 px-5">{{ $index + 1 }}.</td>
                    <td class="py-3 px-5">
                        <div class="w-10 h-10 rounded-md bg-orange-100 flex items-center justify-center">
                            <div class="w-8 h-8 rounded bg-orange-500"></div>
                        </div>
                    </td>
                    <td class="py-3 px-5">{{ $order->customer_name }}</td>
                    <td class="py-3 px-5">
                        @if($order->orderItems->isNotEmpty())
                            {{ $order->orderItems->first()->product->name }}
                            @if($order->orderItems->count() > 1)
                                +{{ $order->orderItems->count() - 1 }} more
                            @endif
                        @else
                            No items
                        @endif
                    </td>
                    <td class="py-3 px-5">{{ $order->customer_phone }}</td>
                    <td class="py-3 px-5">{{ $order->order_date->format('M d, Y') }}</td>
                    <td class="py-3 px-5">{{ Str::limit($order->customer_address, 30) }}</td>
                    <td class="py-3 px-5">
                        <span class="bg-pending text-pending_text px-3 py-1 rounded-full text-xs">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-5">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.orders.edit', $order) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this order?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="py-3 px-5 text-center text-gray-500">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection