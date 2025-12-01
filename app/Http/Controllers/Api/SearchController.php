<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   public function search(Request $request)
{
    try {
       $keyword = $request->query('name'); // كلمة البحث (اختياري)
    $categoryId = $request->query('category_id'); // كاتجوري (اختياري)
    $subCategoryId = $request->query('sub_category_id'); // ساب (اختياري)

    $products = Product::with('mainImage', 'subCategory.category')
        ->when($keyword, function ($q) use ($keyword) {
            // بحث بالاسم فقط
            $q->where('name', 'LIKE', "%$keyword%");
        })
        ->when($subCategoryId, function ($q) use ($subCategoryId) {
            // بحث بالساب كاتيجوري
            $q->where('sub_category_id', $subCategoryId);
        })
        ->when($categoryId, function ($q) use ($categoryId) {
            // بحث بالكاتيجوري داخل الساب
            $q->whereHas('subCategory', function ($sub) use ($categoryId) {
                $sub->where('category_id', $categoryId);
            });
        })
            ->get();

        
        if ($products->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No results found',
                'data' => []
            ], 404);
        }

    
        return response()->json([
            'status' => true,
            'message' => 'Products found',
            'data' => $products
        ]);

    } catch (\Exception $e) {
        // ❌ Error handling
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
}


}
