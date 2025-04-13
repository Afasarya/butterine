<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(4)->get();
        $featuredProducts = Product::where('is_featured', true)->take(3)->get();
        
        return view('home', compact('categories', 'featuredProducts'));
    }
    
    public function product($id)
    {
        $product = Product::findOrFail($id);
        
        // Create WhatsApp link with product info
        $message = "Hello, I would like to order: {$product->name}";
        $whatsappUrl = "https://wa.me/+6281234567890?text=" . urlencode($message);
        
        return view('product', compact('product', 'whatsappUrl'));
    }
}