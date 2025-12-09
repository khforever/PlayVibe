<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display all products (GET /api/products)
     */
   public function index(Request $request)
{
    $pageIndex = $request->page_index ?? 1;
    $itemCount = $request->item_count ?? 20;

    $categoryId = $request->category_id;
    $subCategoryId = $request->sub_category_id;
    $sortBy = $request->sort_by ?? 'id';

    $query = Product::with([
        'MainImage',
        'images',
        'subCategory',
        'variants.color',
        'variants.size'
    ]);

    if ($categoryId) {
        $query->whereHas('subCategory', function($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });
    }


    if ($subCategoryId) {
        $query->where('sub_category_id', $subCategoryId);
    }

     switch ($sortBy) {
        case 'new':
            $query->orderBy('id', 'desc');
            break;

        case 'alpha_up':
            $query->orderBy('name', 'asc');
            break;

        case 'alpha_down':
            $query->orderBy('name', 'desc');
            break;

        case 'price_up':
            $query->orderBy('price', 'asc');
            break;

        case 'price_down':
            $query->orderBy('price', 'desc');
            break;

        default:
         
            $query->orderBy('id', 'desc');
            break;
    }

    // Pagination
    $products = $query->paginate($itemCount, ['*'], 'page', $pageIndex);

    if ($products->isEmpty()) {
    return response()->json(['error' => 'No products found'], 404);
    }
    return response()->json([
        'status' => true,
        'message' => 'Products retrieved successfully.',
        'pagination' => [
            'current_page' => $products->currentPage(),
            'total_items' => $products->total(),
            'items_per_page' => $products->perPage(),
            'total_pages' => $products->lastPage(),
            'has_more_pages' => $products->hasMorePages(),
        ],
        'data' => $products->items(),
    ]);
}


    /**
     * Store a newly created product (POST /api/products)
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $product = Product::create($validated);

            $paths = 'assets/dashboard/products/';
            ImageManager::uploadImage($request, $product, $paths);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product created successfully.',
                'data' => $product->load('images'),
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create product.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified product (GET /api/products/{id})
     */
   public function show($id)
{
    // تحميل المنتج مع كل العلاقات
    $product = Product::with([
        'images',
        'attributes',
        'subCategory',
        'variants.color',
        'variants.size',
        'reviews.user'
    ])->find($id);

    if (!$product) {
        return response()->json([
            'status' => false,
            'message' => 'Product not found.',
        ], 404);
    }

    // الريفيوهات
    $reviews = $product->reviews;

    // عدد الريفيوهات
    $reviewsCount = $reviews->count();

    // متوسط التقييم
    $averageRating = $reviewsCount > 0 
        ? round($reviews->avg('rating'), 1)
        : 0;

    // إحصائيات عدد النجوم 1 → 5
    $ratingStatsRaw = $product->reviews()
        ->selectRaw('rating, COUNT(*) as total')
        ->groupBy('rating')
        ->orderBy('rating', 'desc')
        ->get()
        ->mapWithKeys(fn($row) => [$row->rating => $row->total]);

    // ترتيب الإحصائيات بشكل ثابت
    $ratingStats = [];
    for ($i = 5; $i >= 1; $i--) {
        $ratingStats[$i] = $ratingStatsRaw[$i] ?? 0;
    }

    return response()->json([
    'status' => true,
    'data' => [
        'product' => $product,
        'reviews' => $product->reviews, 
    ],
    'reviews_summary' => [
        'count' => $reviewsCount,
        'average' => $averageRating,
        'stars' => $ratingStats
    ],
]);
}

    /**
     * Update a product (PUT/PATCH /api/products/{id})
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $validated = $request->validated();

            $product->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'sub_category_id' => $validated['sub_category_id'],
            ]);

            $paths = 'assets/dashboard/products/';

            if ($request->hasFile('images')) {
                ImageManager::updateImage($request, $product, $paths);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully.',
                'data' => $product->load('images'),
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update product.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a product (DELETE /api/products/{id})
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);
        }

        ImageManager::deleteImages($product);
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully.',
        ]);
    }

    /**
     * Delete a single image (DELETE /api/products/image/{id})
     */
    public function deleteImage($id)
    {
        $image = ProductImage::find($id);

        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found.',
            ], 404);
        }

        if (File::exists(public_path($image->image_url))) {
            File::delete(public_path($image->image_url));
        }

        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully.',
        ]);
    }
}
