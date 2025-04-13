<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        // Update category item count
        $category = Category::find($request->category_id);
        $category->item_count = $category->products()->count();
        $category->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        // Check if category has changed
        $oldCategoryId = $product->category_id;
        
        $product->update($data);

        // Update old and new category item counts if needed
        if ($oldCategoryId != $request->category_id) {
            $oldCategory = Category::find($oldCategoryId);
            $oldCategory->item_count = $oldCategory->products()->count();
            $oldCategory->save();
            
            $newCategory = Category::find($request->category_id);
            $newCategory->item_count = $newCategory->products()->count();
            $newCategory->save();
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $categoryId = $product->category_id;
        
        $product->delete();

        // Update category item count
        $category = Category::find($categoryId);
        $category->item_count = $category->products()->count();
        $category->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}