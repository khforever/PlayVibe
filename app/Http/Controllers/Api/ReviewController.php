<?php

namespace App\Http\Controllers\Api;
use Auth;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        
    $userId = auth()->id(); 

    if (!$userId) {
        return response()->json([
            'message' => 'Unauthorized: User not logged in'
        ], 401);
    }
        try {
   
        $review = Review::create([
            'user_id' => auth()->id(),  
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Review added successfully',
            'data' => $review
        ], 201);

    } catch (\Exception $e) {

        return response()->json([
            'message' => 'Failed to add review',
            'error' => $e->getMessage()
        ], 500);
    }
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        
        if ($review->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden: You cannot edit this review'], 403);
        }

        $review->update([
            'rating' => $request->rating ?? $review->rating,
            'comment' => $request->comment ?? $review->comment,
        ]);

        return response()->json([
            'message' => 'Review updated successfully',
            'data' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
              $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // مينفعش تمسح غير بتاعك
        if ($review->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden: You cannot delete this review'], 403);
        }

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
