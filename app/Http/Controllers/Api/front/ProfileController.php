<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\ProductVariant;
use App\Models\OrderItem;

class ProfileController extends Controller
{
    use Common;

    public function updateprofile(Request $request)
    {
         $user = $request->user();

        $data = $request->validate([
             'first_name' => 'sometimes|string|max:255',
            'last_name'  => 'sometimes|string|max:255',
            'phone'      => 'sometimes|string',
            'address'    => 'sometimes|string|max:255',
            'city'       => 'sometimes|string|max:255',
            'email'      => 'sometimes|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|string|min:6',
            'image'      => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        if($request->hasfile('image'))
        {
        $data['image'] = $this->uploadFile($request->image,'assets/images');

        }

       if ($request->password)
         {
        $data['password'] = Hash::make($request->password);
    } else {
        unset($data['password']);
    }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);

    }

//change password
     public function changePassword(Request $request)
    {
        $user = $request->user();

      $data =  $request->validate([
            'current password' => 'required',
            'new password' => 'required|min:6',
            'confirm password' => 'required|same:new password'
        ]);


        if (!Hash::check($data['current password'], $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->password = Hash::make($data['new password']);
        $user->save();

        return response()->json([
            'message' => 'Password successfully updated'
        ]);
    }



public function latestOrder()
{
    $user = auth()->user();

    $order = Order::with(['items.product'])
        ->where('user_id', $user->id)
        // ->where('status', Order::DELEVERD)
        ->latest()
        ->first();

    if (!$order) {
        return response()->json([
            'message' => 'You have no delivered orders yet'
        ], 200);
    }

    return response()->json([
        'message' => 'Latest delivered order loaded successfully',
        'order' => $order
    ]);
}





public function reorder($id)
{
    $user = auth()->user();

    // 1) نجيب الأوردر اللي هنعمله إعادة طلب
    $order = Order::with('items')->where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    // 2) نحذف الكارت القديم (إن وجد)
    $oldCart = Cart::where('user_id', $user->id)->first();
    if ($oldCart) {
        CartItem::where('cart_id', $oldCart->id)->delete();
        $oldCart->delete();
    }

    // 3) ننشئ كارت جديد
    $cart = Cart::create([
        'user_id' => $user->id
    ]);

    // 4) ننقل عناصر الأوردر للكارت
    foreach ($order->items as $item) {

        // نجيب الـ variant الصحيح من المنتج
        $variant = ProductVariant::where('product_id', $item->product_id)->first();

        if (!$variant) continue;

        CartItem::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
            'quantity' => $item->quantity,
            'price' => $item->price,
        ]);
    }

    return response()->json([
        'message' => 'Order added again to cart successfully',
        'cart' => $cart->load('items')
    ]);
}



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





public function deleteOrder($id)
{
    $user = auth()->user();

    $order = Order::where('id', $id)
        ->where('user_id', $user->id)
        ->where('status', Order::PENDING)
        ->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found or cannot be deleted'], 404);
    }

    // حذف عناصر الأوردر
    $order->items()->delete();

    // حذف الأوردر نفسه
    $order->delete();

    return response()->json([
        'message' => 'Order deleted successfully'
    ]);
}



}
