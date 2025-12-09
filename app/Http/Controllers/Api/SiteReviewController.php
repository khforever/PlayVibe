<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreSiteReviewRequest;
use App\Http\Requests\Api\UpdateSiteReviewRequest;
use App\Models\SiteReview;

class SiteReviewController extends Controller
{



    public function index( Request $request) {
        $reviews = SiteReview::with('user')->where('is_approved',true)->get();
        return response()->json([
            'success' => true,
            'data' => $reviews
        ], 200);
    }


      public function store( StoreSiteReviewRequest $request) {

        $reviewData = $request->validated();

        $userID= auth()->id();
        if (!$userID) {
            return response()->json([
                'message' => 'Unauthorized: User not logged in'
            ], 401);
        }
        $reviewData['user_id'] = auth()->id();
        $review = SiteReview::create($reviewData);
        return response()->json([
            'success' => true,
            'message' => 'Review submitted Successfully,pending for approval!',
            'data' => $review
        ], 201);

      }



      public function show( Request $request ) {
         $userID= auth()->id();
        if (!$userID) {
            return response()->json([
                'message' => 'Unauthorized: User not logged in'
            ], 401);
        }
        $user= auth()->user();
        $review = SiteReview::where('user_id', $user->id)->get();
        return response()->json([
            'success' => true,
            'data' => $review
        ], 200);
      }


      public function update(UpdateSiteReviewRequest $request, string $id) {
    // to check at post man


        $userID= auth()->id();
        if (!$userID) {
            return response()->json([
                'message' => 'Unauthorized: User not logged in'
            ], 401);
        }
        $user= auth()->user();
       $reviewData= $request->validated();
        $review = SiteReview::where('user_id', $user->id)->findOrFail($id);
        $review->update([
            'rating' => $reviewData['rating'],
            'review' => $reviewData['review'],
            'is_approved' => 0
        ]);
        return response()->json([
            'success' => true,
            'data' => $review
        ], 200);


      }


   public function destroy(string $id) {
          $userID= auth()->id();
        if (!$userID) {
            return response()->json([
                'message' => 'Unauthorized: User not logged in'
            ], 401);
        }
        $user= auth()->user();
        $review = SiteReview::findOrFail($id);
        if($review->user_id !== $user->id) {
            return response()->json([
                'message' => 'Forbidden: You cannot delete this review'
            ], 403);
        }
        $review->delete();
        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully',
            'data' => $review
        ], 200);
   }
}
