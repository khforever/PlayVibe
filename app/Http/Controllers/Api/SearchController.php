<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
public function search(Request $request)
{
    try {
        $keyword = $request->query('name');

        if (!$keyword) {
            return response()->json([
                'status' => false,
                'message' => 'Keyword is required',
            ], 400);
        }

        // ⭐ 1) بحث بالمنتج مباشرة
        $products = Product::with('mainImage','subCategory.category')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get();

        // ⭐ 2) بحث في الـ Category
        $category = Category::where('name', 'LIKE', "%{$keyword}%")->first();

        if ($category) {
            $categoryProducts = Product::with('mainImage','subCategory.category')
                ->whereHas('subCategory', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                })
                ->get();

            $products = $products->merge($categoryProducts);
        }

        // ⭐ 3) بحث في الـ SubCategory
        $subCategory = SubCategory::where('name', 'LIKE', "%{$keyword}%")->first();

        if ($subCategory) {
            $subProducts = Product::with('mainImage','subCategory.category')
                ->where('sub_category_id', $subCategory->id)
                ->get();

            $products = $products->merge($subProducts);
        }

        // إزالة التكرار (لو المنتج جه من أكتر من مكان)
        $products = $products->unique('id')->values();

        if ($products->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No products found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Results found',
            'data' => $products
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
}


}
