<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\SubCategory;
use App\Utils\ImageManager;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::with('MainImage')->get();
       $attributes = Attribute::with('product')->get();
        return view('dashboard.products.index',compact('products','attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $subCategories = SubCategory::all();
        return view('dashboard.products.create',compact('subCategories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //  dd($request->all());
          try {
            DB::beginTransaction();
           $productDataValidated = $request->validated();
           $product = Product::create($productDataValidated);
           $paths='assets/dashboard/products/';
           ImageManager::uploadImage($request, $product, $paths);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    //     Session::flash('success', 'Your registration was successful.');
    //     return redirect()->back();
    //   $productDataValidated = $request->validated();
    //   $product = Product::create($productDataValidated);
      return redirect()->route('products.index')->with('success', 'Product Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $subCategories = SubCategory::all();
        $product = Product::with(['images'])->findOrFail($id);
        return view('dashboard.products.edit',compact('product','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
        DB::beginTransaction();
        $product = Product::findOrFail($id);
        $productDataValidated = $request->validated();
        $product->update([
            'name'=>$productDataValidated['name'],
            'description'=>$productDataValidated['description'],
            'price'=>$productDataValidated['price'],
            'sub_category_id'=>$productDataValidated['sub_category_id'],
        ]);
        $paths='assets/dashboard/products';

   
    if ($request->hasFile('images')) {
        ImageManager::updateImage($request, $product, $paths);
    }
         DB::commit();
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully!');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product=Product::findOrFail($id);
          ImageManager::deleteImages($product);
        $product->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully!');

    }
    public function deleteImage($id)
{
    $image = ProductImage::findOrFail($id);

    if (File::exists(public_path($image->image_url))) {
        File::delete(public_path($image->image_url));
    }

    $image->delete();

    return response()->json(['success' => true]);
}

}
