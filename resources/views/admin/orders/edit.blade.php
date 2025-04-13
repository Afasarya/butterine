<!-- resources/views/admin/orders/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Edit Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-primary hover:underline">
            <i class="fas fa-arrow-left mr-1"></i> Back to Orders
        </a>
    </div>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Customer Information -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 border-b pb-2">Customer Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="customer_name" class="block text-gray-700 mb-2">Customer Name</label>
                    <input 
                        type="text" 
                        id="customer_name" 
                        name="customer_name"
                        value="{{ old('customer_name', $order->customer_name) }}"
                        placeholder="Enter customer name" 
                        class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('customer_name') border border-red-500 @enderror"
                        required
                    >
                    @error('customer_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="customer_phone" class="block text-gray-700 mb-2">Phone Number</label>
                    <input 
                        type="text" 
                        id="customer_phone" 
                        name="customer_phone"
                        value="{{ old('customer_phone', $order->customer_phone) }}"
                        placeholder="Enter customer phone number" 
                        class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('customer_phone') border border-red-500 @enderror"
                        required
                    >
                    @error('customer_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="customer_address" class="block text-gray-700 mb-2">Address</label>
                    <textarea 
                        id="customer_address" 
                        name="customer_address"
                        placeholder="Enter customer address" 
                        class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent h-20 @error('customer_address') border border-red-500 @enderror"
                        required
                    >{{ old('customer_address', $order->customer_address) }}</textarea>
                    @error('customer_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Order Information -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 border-b pb-2">Order Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="order_date" class="block text-gray-700 mb-2">Order Date</label>
                    <input 
                        type="date" 
                        id="order_date" 
                        name="order_date"
                        value="{{ old('order_date', $order->order_date->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('order_date') border border-red-500 @enderror"
                        required
                    >
                    @error('order_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-gray-700 mb-2">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border border-red-500 @enderror"
                        required
                    >
                        <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Order Items Display -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 border-b pb-2">Order Items</h2>
            <div class="overflow-x-auto bg-gray-50 p-4 rounded-md">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-gray-600 text-sm">
                            <th class="py-2 px-4 text-left">Product</th>
                            <th class="py-2 px-4 text-left">Price</th>
                            <th class="py-2 px-4 text-left">Quantity</th>
                            <th class="py-2 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 px-4">{{ $item->product->name }}</td>
                            <td class="py-2 px-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-2 px-4">{{ $item->quantity }}</td>
                            <td class="py-2 px-4 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-right font-semibold">Total:</td>
                            <td class="py-2 px-4 text-right font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
                <p class="mt-3 text-sm text-gray-500">To modify order items, please delete this order and create a new one.</p>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-primary text-white font-medium rounded-md hover:bg-primary/90 transition">
                Update Order
            </button>
        </div>
    </form>
</div>
@endsection