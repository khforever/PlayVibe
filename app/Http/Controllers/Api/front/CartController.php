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
use App\Models\Favourite;

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
            'status'  => false,
            'message' => 'Validation failed',
            'errors'  => $validator->errors(),
        ], 422);
    }

    $user = $request->user();


    $cart = Cart::where('user_id', $user->id)->latest()->first();

    if (!$cart) {
        $cart = Cart::create([
            'user_id' => $user->id
        ]);
    }

    $addedItems = [];
    $cartTotal  = 0;

    foreach ($request->items as $item) {

        $product = null;
        $variant = null;


        if (!empty($item['product_variant_id'])) {

            $variant = ProductVariant::with('product')->find($item['product_variant_id']);

            if (!$variant || !$variant->product) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Variant or product not found'
                ], 404);
            }

            $product = $variant->product;
            $price   = $product->price;

            $cartItem = CartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                ],
                [
                    'product_id'  => $product->id,
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                    'total_price' => $price * $item['quantity'],
                ]
            );
        }


        else {

            $product = Product::find($item['product_id']);

            if (!$product) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Product not found'
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
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                    'total_price' => $price * $item['quantity'],
                ]
            );
        }


        $cartItem = CartItem::with([
            'product' => function ($q) {
                $q->with([
                    'images',
                    'attributes',
                    'subCategory',
                    'variants.color',
                    'variants.size'
                ]);
            },
            'variant',
            'variant.product.images',
            'variant.product.subCategory'
        ])->find($cartItem->id);


        if ($cartItem->product) {
            $cartItem->product->is_favourite = Favourite::where('user_id', $user->id)
                ->where('product_id', $cartItem->product->id)
                ->exists();
        }

        $cartTotal += $cartItem->total_price;
        $addedItems[] = $cartItem;
    }

    return response()->json([
        'status' => true,
        'message' => 'Items added successfully',
        'cart_id' => $cart->id,
        'total_cart_price' => $cartTotal,
        'items' => $addedItems
    ], 201);
}



public function addItems2(Request $request)
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
            'errors'  => $validator->errors(),
        ], 422);
    }

    $userId = $request->user()->id;

    $cart = Cart::firstOrCreate([
        'user_id' => $userId,
    ]);

    $addedItems = [];
    $cartTotal  = 0;

    foreach ($request->items as $item) {

        $product = null;
        $variant = null;
        $price   = 0;


        if (!empty($item['product_variant_id'])) {

            $variant = ProductVariant::with('product')->find($item['product_variant_id']);

            if (!$variant || !$variant->product) {
                return response()->json([
                    'message' => 'Variant or parent product not found',
                ], 404);
            }

            $product = $variant->product;
            $price   = $product->price;



            $cartItem = CartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                ],
                [
                    'product_id'  => $product->id,
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                    'total_price' => $price * $item['quantity'],
                ]
            );
        }


        else {

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
                    'quantity'    => $item['quantity'],
                    'price'       => $price,
                    'total_price' => $price * $item['quantity'],
                ]
            );
        }

        $cartTotal += $cartItem->total_price;


        $addedItems[] = CartItem::with([
            'product',
            'variant',
            'variant.product'
        ])->find($cartItem->id);
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
            'errors'  => $validator->errors(),
            'status'  => false
        ], 422);
    }

    $item = CartItem::with([
        'product',
        'variant',
        'variant.product'
    ])->find($id);

    if (!$item) {
        return response()->json([
            'message' => 'Cart item not found',
            'status'  => false
        ], 404);
    }


    $product = $item->variant
        ? $item->variant->product
        : $item->product;

    $price = $product->price;

    $item->quantity    = $request->quantity;
    $item->price       = $price;
    $item->total_price = $price * $request->quantity;

    if (!$item->save()) {
        return response()->json([
            'message' => 'Failed to update cart item',
            'status'  => false
        ], 500);
    }


    $item->load([
        'product',
        'variant',
        'variant.product'
    ]);

    return response()->json([
        'message' => 'Item updated successfully',
        'status'  => true,
        'item'    => $item
    ], 200);
}




public function removeItem(string $id)
{
    $item = CartItem::with([
        'cart.items.product',
        'cart.items.variant',
        'cart.items.variant.product'
    ])->find($id);

    if (!$item) {
        return response()->json([
            'message' => 'Cart item not found',
            'status'  => false
        ], 404);
    }

    $cart = $item->cart;

    if (!$item->delete()) {
        return response()->json([
            'message' => 'Failed to delete cart item',
            'status'  => false
        ], 500);
    }

     $cart->load([
        'items.product',
        'items.variant',
        'items.variant.product'
    ]);

    $cartTotal = $cart->items->sum('total_price');

    return response()->json([
        'message' => 'Item removed successfully',
        'status'  => true,
        'total_cart_price' => $cartTotal,
        'items' => $cart->items
    ], 200);
}



public function getCartItems(Request $request)
{
    $user = $request->user();


    $cart = Cart::where('user_id', $user->id)
        ->latest()
        ->first();

    if (!$cart) {
        return response()->json([
            'status' => true,
            'message' => 'Cart is empty',
            'cart_id' => null,
            'total_cart_price' => 0,
            'items' => []
        ], 200);
    }


    $cart->load([
        'items' => function ($q) {
            $q->with([
                'product' => function ($q) {
                    $q->with([
                        'images',
                        'attributes',
                        'subCategory',
                        'variants.color',
                        'variants.size'
                    ]);
                },
                'variant',
                'variant.product.images',
                'variant.product.subCategory'
            ]);
        }
    ]);

    if ($cart->items->isEmpty()) {
        return response()->json([
            'status' => true,
            'message' => 'Cart is empty',
            'cart_id' => $cart->id,
            'total_cart_price' => 0,
            'items' => []
        ], 200);
    }

    
    foreach ($cart->items as $item) {
        if ($item->product) {
            $item->product->is_favourite = Favourite::where('user_id', $user->id)
                ->where('product_id', $item->product->id)
                ->exists();
        }
    }

    $totalCartPrice = $cart->items->sum('total_price');

    return response()->json([
        'status' => true,
        'message' => 'Cart items retrieved successfully',
        'cart_id' => $cart->id,
        'total_cart_price' => $totalCartPrice,
        'items' => $cart->items
    ], 200);
}





public function getCartItems2(Request $request)
{
    $userId = $request->user()->id;

    $cart = Cart::with([
        'items.product',
        'items.variant',
        'items.variant.product'
    ])->where('user_id', $userId)->first();

    if (!$cart || $cart->items->isEmpty()) {
        return response()->json([
            'message' => 'Cart is empty',
            'status'  => true,
            'total_cart_price' => 0,
            'items' => []
        ], 200);
    }

    $totalCartPrice = $cart->items->sum('total_price');


    return response()->json([
        'message' => 'Cart items retrieved successfully',
        'status'  => true,
        'cart_id' => $cart->id,
        'total_cart_price' => $totalCartPrice,
        'items' => $cart->items
    ], 200);
}







}
