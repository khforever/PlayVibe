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
        $user = auth()->user();
        $favourite = Favourite::with([
            'product.images',
            'product.variants.color',
            'product.variants.size',
            'product.subCategory',
            'product.reviews',
            'product.attributes'
        ])
        ->where('user_id', $user->id)
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

    function toggle(Request $request, $product_id)
    {
        $user = $request->user();

        $fav = Favourite::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();

        if ($fav) {
            $fav->delete();
            return response()->json([
                'status' => true,
                'message' => 'Removed from favourites',
                'is_favourite' => false
            ]);
        } else {
            $fav = Favourite::create([
                'user_id' => $user->id,
                'product_id' => $product_id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Added to favourites',
                'is_favourite' => true
            ]);
        }
    }

    
    
}