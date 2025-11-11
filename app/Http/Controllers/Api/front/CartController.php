<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Exception;

use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //add item




public function addItems(Request $request)
{
    // تحقق يدوي من البيانات بدون ValidationException
    $validator = Validator::make($request->all(), [
        'items' => 'required|array|min:1',
        'items.*.product_variant_id' => 'required|exists:product_variants,id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    $userId = $request->user()->id;

    $cart = Cart::firstOrCreate([
        'user_id' => $userId
    ]);

    $addedItems = [];
    $cartTotal = 0;

    foreach ($request->items as $item) {
        $variant = ProductVariant::with('product')->find($item['product_variant_id']);

        if (!$variant) {
            return response()->json([
                'message' => 'Variant not found',
                'variant_id' => $item['product_variant_id']
            ], 404);
        }

        if (!$variant->product) {
            return response()->json([
                'message' => 'Product not found for this variant',
                'variant_id' => $variant->id
            ], 404);
        }

        $price = $variant->product->price ?? 0;
        if ($price <= 0) {
            return response()->json([
                'message' => 'Invalid product price',
                'product_id' => $variant->product->id
            ], 400);
        }

        $total = $price * $item['quantity'];

        $cartItem = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_variant_id' => $variant->id,
            ],
            [
                'quantity' => $item['quantity'],
                'price' => $price,
                'total_price' => $total,
            ]
        );

        if (!$cartItem) {
            return response()->json([
                'message' => 'Failed to add item to cart',
                'variant_id' => $variant->id
            ], 500);
        }

        $addedItems[] = $cartItem;
        $cartTotal += $total;
    }

    $cart->update(['total_price' => $cartTotal]);

    return response()->json([
        'message' => 'Items added successfully',
        'items' => $addedItems,
        'total_cart_price' => $cartTotal
    ], 201);
}


















    //update item


public function updateItem(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'quantity' => 'required|integer|min:1'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
            'status' => false
        ], 422);
    }

    $item = CartItem::with('variant.product')->find($id);

    if (!$item) {
        return response()->json([
            'message' => 'Cart item not found',
            'status' => false
        ], 404);
    }

    $item->quantity = $request->quantity;
    $item->total_price = $item->price * $request->quantity;

    if (!$item->save()) {
        return response()->json([
            'message' => 'Failed to update cart item',
            'status' => false
        ], 500);
    }

    return response()->json([
        'message' => 'Item updated successfully',
        'status' => true,
        'item' => $item
    ], 200);
}












public function updateItem1(Request $request,string $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $item = CartItem::with('variant.product')
                          ->findOrFail($id);

        $item->quantity = $request->quantity;
        $item->total_price = $item->price * $request->quantity;

        $item->save();

        return response()->json([
            'message' => 'Item updated successfully',
            'item' => $item
        ]);
    }


//delete item

 public function removeItem(string $id)
{

    $item = CartItem::find($id);


    if (!$item) {
        return response()->json([
            'message' => 'Cart item not found',
            'status' => false
        ], 404);
    }


    $deleted = $item->delete();

    if (!$deleted) {
        return response()->json([
            'message' => 'Failed to delete cart item',
            'status' => false
        ], 500);
    }

 
    if ($item->cart) {
        $newTotal = $item->cart->items()->sum('total_price');
        $item->cart->update(['total_price' => $newTotal]);
    }

    return response()->json([
        'message' => 'Item removed successfully',
        'status' => true
    ], 200);
}











//index
public function index(Request $request)
{
    $user =  $request->user()->id;

    $cart = Cart::firstOrCreate(['user_id' =>$user]);

    $items = $cart->items;

    $total = $items->sum('total_price');

    return response()->json([
        'cart_id' => $cart->id,
        'total' => $total,
        'items' => $items
    ]);
}




}
