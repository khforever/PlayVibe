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
    $categoryData = $request->validated();

    if ($request->hasFile('image')) {
        $imagePath = 'assets/dashboard/categories';

        $imageName = UploadImageTrait::uploadImage($request, $imagePath);

        $oldFile = $category->image;
        $oldPath = "$imagePath/$oldFile";
        UploadImageTrait::DeleteImage($oldPath);
        $categoryData['image'] = $imageName;
    }

    $category->update($categoryData);

    return redirect()->route('categories.index')
        ->with('success', 'Category Updated Successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $category = Category::findOrFail($id);

    $hasOrders = $category->subCategories()
        ->whereHas('products.orderItems')
        ->exists();

    if ($hasOrders) {

        return redirect()->route('categories.index')->with('error', 'Cannot delete this category because some products under it are linked to customer orders.');
    }


    if ($category->image) {
        UploadImageTrait::DeleteImage("assets/dashboard/categories/{$category->image}");
    }

    $category->subCategories()->delete();


    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully!');
}
}
