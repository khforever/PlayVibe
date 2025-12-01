<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\Common;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $subcategories = SubCategory::with('category')->get();
        return view('dashboard.subcategories.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('dashboard.subcategories.create',compact('categories'));
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'name'=>'required|string',
            'category_id'=>'required|integer|exists:categories,id',
            'image' =>'required|mimes:png,jpg,jpeg|max:2048',

        ]);
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assets/dashboard/subcategory');
        }

        SubCategory::create($data);

         if ($request->hasFile('image')) 
            {
                     $subcategory->addMedia($request->file('image'))
                     ->toMediaCollection('images');
            }

        return redirect()->route('subcategory.index');
    }

//     public function store(Request $request)
// {
//     $data = $request->validate([
//         'name'        => 'required|string',
//         'category_id' => 'required|integer|exists:categories,id',
//         'image'       => 'nullable|mimes:png,jpg,jpeg|max:2048',
//     ]);

//     $subcategory = SubCategory::create($data);

//     if ($request->hasFile('image')) {
//         $subcategory->addMedia($request->file('image'))
//                     ->toMediaCollection('image');
//     }

//     return redirect()->route('subcategory.index');
// }


    //edit
    public function edit(string $id)
    {
        $subcategory = SubCategory::findOrfail($id);
        $categories = Category::select('id','name')->get();
        return view('dashboard.subcategories.edit',compact('subcategory','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function update(Request $request, string $id)
    {
        $data = $request->validate([

            'name'=>'required|string',
            'category_id'=>'required|integer|exists:categories,id',
            'image' =>'sometimes|mimes:png,jpg,jpeg|max:2048',

        ]);

        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assets/dashboard/subcategory');
        }
        
        SubCategory::where('id',$id)->update($data);
        return redirect()->route('subcategory.index');
    }

   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        SubCategory::where('id',$id)->delete($id);
        return redirect()->route('subcategory.index');
    }
}
