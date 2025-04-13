<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
        ]);

        // Calculate total price
        $totalPrice = 0;
        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantity[$key];
            $totalPrice += $product->price * $quantity;
        }

        // Create order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_price' => $totalPrice,
            'status' => $request->status,
            'order_date' => $request->order_date,
        ]);

        // Create order items
        foreach ($request->product_id as $key => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantity[$key];
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
            
            // Update product sold count
            $product->sold_count += $quantity;
            $product->save();
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load('orderItems.product');
        $products = Product::all();
        return view('admin.orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'status' => $request->status,
            'order_date' => $request->order_date,
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        // Revert product sold counts
        foreach ($order->orderItems as $item) {
            $product = $item->product;
            $product->sold_count -= $item->quantity;
            $product->save();
        }
        
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully');
    }
}