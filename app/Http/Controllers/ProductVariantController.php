<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productID)
    {
        $product=Product::with(['variants.color','variants.size'])->findOrFail($productID);
        $colors=Color::all();
        $sizes=Size::all();
        return view('dashboard.productVariants.index',compact('product','colors','sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "product_id" => "required|exists:products,id",
            "color_id" => "required|exists:colors,id",
            "size_id" => "required|exists:sizes,id",

        ]);

        $existingVariant = ProductVariant::where('product_id', $validated['product_id'])
        ->where('color_id', $validated['color_id'])
        ->where('size_id', $validated['size_id'])->first();

        if ($existingVariant) {
            return redirect()->back()->with('error', 'Variant already exists');
        }

        ProductVariant::create($validated);
        return redirect()->back()->with('success', 'Variant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $productVariant, $variantID )
    {
        $productVariant=ProductVariant::findOrFail($variantID);
        $productVariant->delete();
        return redirect()->back()->with('success', 'Variant deleted successfully');
    }
}
