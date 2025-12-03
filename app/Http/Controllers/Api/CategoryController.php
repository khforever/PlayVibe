<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Traits\UploadImageTrait;

class CategoryController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
          $categories->map(function ($cat) {
        $cat->image = asset('assets/dashboard/categories/' . $cat->image);
        return $cat;
    });
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
       $category = Category::find($id);
       if(!$category){
        return response()->json([
            'success' => false,
            'message' => 'Category not found',
        ], 404);
       }
       else{
        return response()->json([
        'success' => true,
        'data'=>['id'=>$category->id,
        'name'=>$category->name,
        'image'=>$category->image_url]

       ], 200);
       }

    }

    /**
     * Update the specified resource in storage.
     */


    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data = $request->validated();
            if ($request->hasFile('image')) {
            //upload image
            $imagePath = 'assets/dashboard/categories';
            $newImageName = UploadImageTrait::uploadImage($request, $imagePath);
            //remove old image

            $oldImage = $category->image;
            $Path = "assets/dashboard/categories/{$oldImage}";
            $deletedFile = UploadImageTrait::DeleteImage($Path);
            if ($oldImage ) {
                    $data['image'] = $newImageName;
            }


        }


        $category->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'image_url' => $category->image ? asset($category->image) : null,
            ]
        ], 200);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category )
    {

        $oldCategoryImage = $category->image;
        $Path = "assets/dashboard/categories/{$oldCategoryImage}";
        $deletedCategoryImage = UploadImageTrait::DeleteImage($Path);
        if ($deletedCategoryImage) {


        $category->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
