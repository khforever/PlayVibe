<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteReview;

class SiteReviewController extends Controller
{





    public function index()
    {
        $siteReviews=SiteReview::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.siteReview.index',compact('siteReviews'));

    }


    public function approve($id){
        $siteReview=SiteReview::findOrfail($id);
        $siteReview->is_approved=! $siteReview->is_approved;
        $siteReview->save();
        return redirect()->route('site-reviews.index')->with('success','status updated successfully');
    }
}
