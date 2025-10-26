<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('dashboard.categories.create');
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
        Category::create([
            'name'=>$request->name,
            'image'=>$categoryData['image']
        ]);
        return redirect()->route('categories.index')->with('success', 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {

        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $categoryData=$request->validated();
    //if selected new image
        if ($request->hasFile('image')) {
            //upload image
            $imagePath = 'assets/dashboard/categories';
            $imageName = UploadImageTrait::uploadImage($request, $imagePath);
            //remove old image

            $oldFile = $category->image;
            $Path = "assets/dashboard/categories/{$oldFile}";
            $deletedFile = UploadImageTrait::DeleteImage($Path);
            if ($deletedFile) {

                $categoryData['image'] = $imageName;


            }
        }
            $categoryData['name'] = $request->name;
            $category->update($categoryData);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::findOrFail($id);
        // dd($category->image);
        // remove old image
        $oldCategoryImage = $category->image;
        $Path = "assets/dashboard/categories/{$oldCategoryImage}";
        $deletedCategoryImage = UploadImageTrait::DeleteImage($Path);
        if ($deletedCategoryImage) {
        $category->where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully!');
    }
}
}
