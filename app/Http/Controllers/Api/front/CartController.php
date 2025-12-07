<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Exception;

use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class CartController extends Controller
{
    



public function addItems(Request $request)
{
  
    $validator = Validator::make($request->all(), [
        'items' => 'required|array|min:1',
        'items.*.quantity' => 'required|integer|min:1',

       
        'items.*.product_id' => 'required_without:items.*.product_variant_id|exists:products,id',
        'items.*.product_variant_id' => 'required_without:items.*.product_id|exists:product_variants,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    $userId = $request->user()->id;

    $cart = Cart::firstOrCreate([
        'user_id' => $userId,
    ]);

    $addedItems = [];
    $cartTotal = 0;

    foreach ($request->items as $item) {

        $product = null;
        $variant = null;
        $price = 0;

        /**
         * CASE 1: Variant موجود
         */
        if (!empty($item['product_variant_id'])) {

            $variant = ProductVariant::with('product')->find($item['product_variant_id']);

            if (!$variant || !$variant->product) {
                return response()->json([
                    'message' => 'Variant or parent product not found',
                ], 404);
            }

            $product = $variant->product;
            $price = $product->price;  

            $cartItem = CartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                ],
                [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total_price' => $price * $item['quantity'],
                ]
            );
        }

        /**
         * CASE 2: Product بدون Variants
         */
        else if (!empty($item['product_id'])) {

            $product = Product::find($item['product_id']);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }

            $price = $product->price;

            $cartItem = CartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'product_variant_id' => null, 
                  
                ],
                [
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total_price' => $price * $item['quantity'],
                ]
            );
        }

        $addedItems[] = $cartItem;
        $cartTotal += $cartItem->total_price;
    }

    return response()->json([
        'message' => 'Items added successfully',
        'total_cart_price' => $cartTotal,
        'items' => $addedItems,
    ], 201);
}

















   
 


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

     
    $item = CartItem::with(['product', 'variant.product'])->find($id);

    if (!$item) {
        return response()->json([
            'message' => 'Cart item not found',
            'status' => false
        ], 404);
    }

   
    if ($item->variant) {
        
        $price = $item->variant->product->price;
    } else {
      
        $price = $item->product->price;
    }
 
    $item->quantity = $request->quantity;
    $item->price = $price; 
    
    
     $item->total_price = $price * $request->quantity;

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




 

 
 public function removeItem(string $id)
{
     $item = CartItem::with('cart')->find($id);

    if (!$item) {
        return response()->json([
            'message' => 'Cart item not found',
            'status' => false
        ], 404);
    }

   
    if (!$item->delete()) {
        return response()->json([
            'message' => 'Failed to delete cart item',
            'status' => false
        ], 500);
    }

    return response()->json([
        'message' => 'Item removed successfully',
        'status' => true
    ], 200);
}









 
public function index(Request $request)
{
    $userId = $request->user()->id;

   
    $cart = Cart::firstOrCreate(['user_id' => $userId]);

  
    $items = $cart->items()->with('product')->get();

   
    $total = $items->sum(function ($item) {
        return $item->product ? $item->product->price * $item->quantity : 0;
    });

    return response()->json([
        'cart_id' => $cart->id,
        'total'   => $total,
        'items'   => $items,
    ]);
}




}
