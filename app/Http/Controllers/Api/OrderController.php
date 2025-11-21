<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Enum\OrderStatus;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;

class OrderController extends Controller
{

 public function createOrder(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'full_name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'delivery_option' => 'required|integer',
        'payment_method' => 'required|integer',
        'location_lat' => 'required',
        'location_lng' => 'required',
        'notes' => 'nullable|string',
    ]);

    // ---- Get Cart ----
    $cart = Cart::where('user_id', $user->id)->first();
    if (!$cart)
        return response()->json(['message' => 'Cart is empty'], 400);

    $cartItems = CartItem::where('cart_id', $cart->id)->get();
    if ($cartItems->count() == 0)
        return response()->json(['message' => 'Cart has no items'], 400);

    // ---- Calculate Subtotal ----
    $subtotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // ---- Delivery Price ----
    $delivery_price = match ((int)$request->delivery_option) {
        1 => 50,
        2 => 40,
        3 => 70,
        default => 50
    };

    // ---- Create Order ----
    $order = Order::create([
        'user_id' => $user->id,
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'city' => $request->city,
        'delivery_option' => $request->delivery_option,
        'delivery_price' => $delivery_price,
        'notes' => $request->notes,
        'payment_method' => $request->payment_method,
        'location_lat' => $request->location_lat,
        'location_lng' => $request->location_lng,
        'subtotal' => $subtotal,
        'status' => 1
    ]);

    // ---- Move Cart Items → Order Items ----
    foreach ($cartItems as $item) {

        // 1️⃣ نجيب الـ Variant من جدول product_variants
        $variant = ProductVariant::with('product')->find($item->product_variant_id);

        if (!$variant || !$variant->product) {
            return response()->json([
                'message' => 'Product variant not found',
                'variant_id' => $item->product_variant_id
            ], 400);
        }

        // 2️⃣ ندخل البيانات في order_items
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $variant->product->id, // مهم جداً
            'quantity' => $item->quantity,
            'price' => $item->price,
            'total' => $item->price * $item->quantity
        ]);
    }

    // ---- Clear Cart ----
    CartItem::where('cart_id', $cart->id)->delete();
    $cart->delete();

    return response()->json([
        'message' => 'Order created successfully',
        'order' => $order->load('items')
    ]);
}

public function showOrder($id)
{
    $user = auth()->user();

    $order = Order::with(['items.product'])
        ->where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    return response()->json([
        'message' => 'Order details loaded',
        'order' => $order
    ]);
}



public function cancelOrder($id)
{
    $user = auth()->user();
 



    $order = Order::where('id', $id)
        ->where('user_id', $user->id)
         ->where('status', Order::PENDING) // only pending orders can be cancelled
        ->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

 

    // ✅ Cancel
    $order->update(['status' => Order::CANCELLED]); // 2 = Order::CANCELLED; 
   

    return response()->json([
        'message' => 'Order cancelled successfully',
        'order' => $order
    ]);
}



}
