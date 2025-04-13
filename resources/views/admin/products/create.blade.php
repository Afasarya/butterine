<!-- resources/views/admin/products/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Create Product</h1>
        <a href="{{ route('admin.products.index') }}" class="text-primary hover:underline">
            <i class="fas fa-arrow-left mr-1"></i> Back to Products
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-gray-700 mb-2">Product Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter product name" 
                    class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="category_id" class="block text-gray-700 mb-2">Category</label>
                <select 
                    id="category_id" 
                    name="category_id"
                    class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('category_id') border border-red-500 @enderror"
                >
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="price" class="block text-gray-700 mb-2">Price (Rp)</label>
                <input 
                    type="number" 
                    id="price" 
                    name="price"
                    value="{{ old('price') }}"
                    placeholder="Enter product price" 
                    class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('price') border border-red-500 @enderror"
                >
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Featured Product</label>
                <div class="flex items-center mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-5 w-5 text-primary rounded border-gray-300 focus:ring-primary">
                        <span class="ml-2 text-gray-700">Mark as featured product</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-gray-700 mb-2">Description</label>
            <textarea 
                id="description" 
                name="description"
                placeholder="Enter product description" 
                class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent h-32 @error('description') border border-red-500 @enderror"
            >{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Product Image</label>
            <div class="flex items-center">
                <label class="w-full flex flex-col items-center px-4 py-6 bg-gray-100 rounded-md cursor-pointer hover:bg-gray-200">
                    <i class="fas fa-cloud-upload-alt text-gray-500 text-3xl"></i>
                    <span class="mt-2 text-gray-500">Select an image</span>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                </label>
            </div>
            <div id="image-preview" class="mt-3 hidden">
                <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-md">
            </div>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-primary text-white font-medium rounded-md hover:bg-primary/90 transition">
                Create Product
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = imagePreview.querySelector('img');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection