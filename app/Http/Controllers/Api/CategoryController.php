<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Traits\UploadImageTrait;

class CategoryController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
     $categoryData=$request->validated();
     if ($request->hasFile('image')) {
       $imagePath = 'assets/dashboard/categories';
       $imageName = UploadImageTrait::uploadImage($request, $imagePath);
         $categoryData['image'] = $imageName;
     }

       $category= Category::create($categoryData);

    return response()->json([
    'success' => true,
    'message' => 'Category Created Successfully!',
    'data' => $category
], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
