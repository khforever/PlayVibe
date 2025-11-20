<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favourite;

class FavouriteController extends Controller
{


public function index(Request $request)
{
    $favourites = Favourite::with([
        'product.images',
        'product.variants.color',
        'product.variants.size',
        'product.subCategory',
        'product.reviews',
        'product.attributes'
    ])
    ->where('user_id', $request->user()->id)
    ->get();

    return response()->json([
        'status' => true,
        'data' => $favourites
    ]);
}


public function show(Request $request, $product_id)
{
    $favourite = Favourite::with([
        'product.images',
        'product.variants.color',
        'product.variants.size',
        'product.subCategory',
        'product.reviews',
        'product.attributes'
    ])
    ->where('user_id', $request->user()->id)
    ->where('product_id', $product_id)
    ->first();

    if (!$favourite) {
        return response()->json([
            'status' => false,
            'message' => 'Product not found in favourites'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $favourite
    ]);
}








  public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $fav = Favourite::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product added to favourites',
            'data' => $fav
        ]);
    }




public function update(Request $request, $id)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $favourite = Favourite::where('id', $id)
        ->where('user_id', $request->user()->id)
        ->first();

    if (!$favourite) {
        return response()->json([
            'status' => false,
            'message' => 'Favourite item not found.'
        ], 404);
    }

    // Check if product already exists for this user
    $exists = Favourite::where('user_id', $request->user()->id)
        ->where('product_id', $request->product_id)
        ->first();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'This product is already in your favourites.'
        ], 409);
    }

    $favourite->update([
        'product_id' => $request->product_id
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Favourite updated successfully.',
        'data' => $favourite
    ]);
}







    public function destroy(Request $request, $product_id)
    {
        Favourite::where('user_id', $request->user()->id)
            ->where('product_id', $product_id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product removed from favourites'
        ]);

}

}
