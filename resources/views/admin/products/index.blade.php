<!-- resources/views/admin/products/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary/90 transition">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Image</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Category</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-left">Sold</th>
                    <th class="py-3 px-6 text-left">Featured</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse($products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6">
                        <div class="w-16 h-16 rounded overflow-hidden bg-gray-200">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-image"></i>
                            </div>
                            @endif
                        </div>
                    </td>
                    <td class="py-3 px-6">{{ $product->name }}</td>
                    <td class="py-3 px-6">{{ $product->category->name }}</td>
                    <td class="py-3 px-6">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-6">{{ $product->sold_count }}</td>
                    <td class="py-3 px-6">
                        @if($product->is_featured)
                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">Yes</span>
                        @else
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">No</span>
                        @endif
                    </td>
                    <td class="py-3 px-6">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-3 px-6 text-center">No products found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection