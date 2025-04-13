<!-- resources/views/admin/orders/show.blade.php -->
@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Order #{{ $order->id }}</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.orders.edit', $order) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('admin.orders.index') }}" class="text-primary hover:underline flex items-center">
                <i class="fas fa-arrow-left mr-1"></i> Back to Orders
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gray-50 p-4 rounded-md">
            <h2 class="font-semibold text-lg mb-3">Customer Information</h2>
            <p><span class="text-gray-600">Name:</span> {{ $order->customer_name }}</p>
            <p><span class="text-gray-600">Phone:</span> {{ $order->customer_phone }}</p>
            <p><span class="text-gray-600">Address:</span> {{ $order->customer_address }}</p>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-md">
            <h2 class="font-semibold text-lg mb-3">Order Information</h2>
            <p><span class="text-gray-600">Order Date:</span> {{ $order->order_date->format('d M Y') }}</p>
            <p><span class="text-gray-600">Status:</span> 
                <span class="px-2 py-1 rounded-full text-xs
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status == 'completed') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><span class="text-gray-600">Total:</span> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-md">
            <h2 class="font-semibold text-lg mb-3">Order Summary</h2>
            <p><span class="text-gray-600">Items:</span> {{ $order->orderItems->count() }}</p>
            <p><span class="text-gray-600">Total Quantity:</span> {{ $order->orderItems->sum('quantity') }}</p>
            <p><span class="text-gray-600">Created:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>
    
    <div class="mb-6">
        <h2 class="font-semibold text-lg mb-3">Order Items</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Quantity</th>
                        <th class="py-3 px-6 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach($order->orderItems as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 flex items-center">
                            <div class="w-10 h-10 rounded-md bg-gray-200 overflow-hidden mr-3">
                                @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-cookie"></i>
                                </div>
                                @endif
                            </div>
                            {{ $item->product->name }}
                        </td>
                        <td class="py-3 px-6">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="py-3 px-6">{{ $item->quantity }}</td>
                        <td class="py-3 px-6 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="3" class="py-3 px-6 text-right font-semibold">Total:</td>
                        <td class="py-3 px-6 text-right font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection