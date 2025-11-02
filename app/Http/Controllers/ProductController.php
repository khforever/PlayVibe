<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\SubCategory;
use App\Models\Attribute;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::all();
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
      $productDataValidated = $request->validated();
      $product = Product::create($productDataValidated);
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
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit',compact('product','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $productDataValidated = $request->validated();
        $product->update([
            'name'=>$productDataValidated['name'],
            'description'=>$productDataValidated['description'],
            'price'=>$productDataValidated['price'],
            'sub_category_id'=>$productDataValidated['sub_category_id'],
        ]);
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product=Product::findOrFail($id);
        $product->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully!');

    }
}
