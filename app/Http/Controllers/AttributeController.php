<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

public function create($id)
{
    $product = Product::findOrFail($id);
    return view('dashboard.attributes.create', compact('product'));
}




   
    /**
     * Store a newly created resource in storage.
     */






public function store(Request $request, $id)
{
    // التأكد من أن المنتج موجود
    $product = Product::findOrFail($id);

    // التحقق من صحة البيانات
    $data = $request->validate([
        'sumthumb' => 'required|string',
        'additional_info' => 'required|string',
        'dimension' => 'required|string',
        'maincompartment' => 'required|string',
        'durable_fabric' => 'required|string',
        'spacious' => 'required|string',
    ]);

    // ربط الـ attribute بالمنتج
    $data['product_id'] = $product->id;

    // إنشاء الـ attribute
    Attribute::create($data);

    return redirect()->route('products.index')->with('success', 'Attribute added successfully!');
}















     public function store33(Request $request , $id)
    {

     //   $products = Product::select('id','name')->get();

        $products = Product::findOrFail($id);


        $data = $request->validate([
           // 'product_id'=>'required|integer|exists:products,id',
            'sumthumb'=>'required|string',
            'additional_info'=>'required|string',
            'dimension'=>'required|string',
            'maincompartment'=>'required|string',
            'durable_fabric'=>'required|string',
            'spacious'=>'required|string',

        ]);

        Attribute::create($data);
        return redirect()->route('products.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attribute = Attribute::findOrfail($id);
        $products = Product::select('id','name')->get();
        return view('dashboard.attributes.edit',compact('attribute','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
          $data = $request->validate([
            'product_id'=>'required|integer|exists:products,id',
            'sumthumb'=>'nullable|string',
            'additional_info'=>'nullable|string',
            'dimension'=>'nullable|string',
            'maincompartment'=>'nullable|string',
            'durable_fabric'=>'nullable|string',
            'spacious'=>'nullable|string',

        ]);

        Attribute::where('id',$id)->update($data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
