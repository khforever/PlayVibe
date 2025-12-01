<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;

class CartController extends Controller
{
    //add item
   public function addItems(Request $request)
{
    $request->validate([
        'items' => 'required|array|min:1',
        'items.*.product_variant_id' => 'required|exists:product_variants,id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    $user = $request->user()->id;

    $cart = Cart::firstOrCreate([
        'user_id' => $user
    ]);

    $addedItems = [];

    foreach ($request->items as $item) {
        $variant = ProductVariant::with('product')->find($item['product_variant_id']);

        if (!$variant || !$variant->product) {
            return response()->json([
                'message' => 'Product or variant not found'
            ], 404);
        }

        $price = $variant->product->price;
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

        $addedItems[] = $cartItem;
    }

    return response()->json([
        'message' => 'Items added successfully',
        'items' => $addedItems
    ], 201);
}




    //update item
public function updateItem(Request $request,string $id)
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
        $item = CartItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item removed successfully']);
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
