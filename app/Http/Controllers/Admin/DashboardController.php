<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $recentOrders = Order::with('orderItems.product')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        $bestSellers = Product::orderBy('sold_count', 'desc')->take(4)->get();
        
        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalProducts', 
            'totalCategories', 
            'recentOrders',
            'bestSellers'
        ));
    }
}