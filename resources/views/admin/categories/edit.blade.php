<!-- resources/views/admin/categories/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Edit Category: {{ $category->name }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="text-primary hover:underline">
            <i class="fas fa-arrow-left mr-1"></i> Back to Categories
        </a>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label for="name" class="block text-gray-700 mb-2">Category Name</label>
            <input 
                type="text" 
                id="name" 
                name="name"
                value="{{ old('name', $category->name) }}"
                placeholder="Enter category name" 
                class="w-full px-4 py-2.5 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border border-red-500 @enderror"
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-gray-700 mb-2">Description</label>
            <textarea 
                id="description" 
                name="description"
                placeholder="Enter category description" 
                class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent h-32 @error('description') border border-red-500 @enderror"
            >{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Category Image</label>
            
            @if($category->image)
            <div class="mb-3">
                <p class="text-sm text-gray-500 mb-2">Current Image:</p>
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-32 h-32 object-cover rounded-md">
            </div>
            @endif
            
            <div class="flex items-center">
                <label class="w-full flex flex-col items-center px-4 py-6 bg-gray-100 rounded-md cursor-pointer hover:bg-gray-200">
                    <i class="fas fa-cloud-upload-alt text-gray-500 text-3xl"></i>
                    <span class="mt-2 text-gray-500">Select a new image</span>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                </label>
            </div>
            <div id="image-preview" class="mt-3 hidden">
                <p class="text-sm text-gray-500 mb-2">New Image Preview:</p>
                <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-md">
            </div>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-primary text-white font-medium rounded-md hover:bg-primary/90 transition">
                Update Category
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