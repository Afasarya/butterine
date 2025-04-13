<!-- resources/views/admin/orders/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Create Order')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Create Order</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-primary hover:underline">
            <i class="fas fa-arrow-left mr-1"></i> Back to Orders
        </a>
    </div>

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        
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
                        value="{{ old('customer_name') }}"
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
                        value="{{ old('customer_phone') }}"
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
                    >{{ old('customer_address') }}</textarea>
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
                        value="{{ old('order_date', date('Y-m-d')) }}"
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
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Order Items -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 border-b pb-2">Order Items</h2>
            <div id="order-items">
                <div class="order-item bg-gray-50 p-4 rounded-md mb-4">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label class="block text-gray-700 mb-2">Product</label>
                            <select 
                                name="product_id[]"
                                class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                required
                            >
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-4">
                            <label class="block text-gray-700 mb-2">Quantity</label>
                            <input 
                                type="number" 
                                name="quantity[]"
                                value="1"
                                min="1"
                                class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                required
                            >
                        </div>
                        <div class="col-span-2 flex items-end">
                            <button type="button" class="remove-item px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 hidden">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" id="add-item" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                <i class="fas fa-plus mr-1"></i> Add Item
            </button>
            
            @error('product_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-primary text-white font-medium rounded-md hover:bg-primary/90 transition">
                Create Order
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderItems = document.getElementById('order-items');
        const addItemBtn = document.getElementById('add-item');
        
        // Function to handle remove item button
        function handleRemoveItem() {
            const removeButtons = document.querySelectorAll('.remove-item');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemDiv = this.closest('.order-item');
                    itemDiv.remove();
                    
                    // Hide remove button if only one item left
                    if (document.querySelectorAll('.order-item').length === 1) {
                        document.querySelector('.remove-item').classList.add('hidden');
                    }
                });
            });
        }
        
        // Initial setup
        handleRemoveItem();
        
        // Add new item
        addItemBtn.addEventListener('click', function() {
            const firstItem = document.querySelector('.order-item');
            const newItem = firstItem.cloneNode(true);
            
            // Reset values
            newItem.querySelectorAll('select, input').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = input.name === 'quantity[]' ? 1 : '';
                }
            });
            
            // Show remove buttons
            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.classList.remove('hidden');
            });
            newItem.querySelector('.remove-item').classList.remove('hidden');
            
            orderItems.appendChild(newItem);
            handleRemoveItem();
        });
    });
</script>
@endsection