<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSubCategory;
use App\Http\Requests\Api\UpdateSubCategory;
use App\Models\SubCategory;
use App\Traits\Common;
use App\Traits\Response;
use App\Transformers\SubCategoryTransform;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class SubCategoryController extends Controller
{
    use Response;
    use Common;
    /**
     * Display a listing of the resource.
     */
      public function index(Request $request)
{
    $search = $request->input('search');
    $take = $request->input('take'); 
    $skip = $request->input('skip');  
    
    $query = SubCategory::query();

      if ($search)
    {
        $query->where('name','like', '%' . $search . '%');
    }

    $total = $query->count();

    $subcategory = $query->skip($skip ?? 0)->take($take ?? $total)->get();

     $subcategory =  fractal()->collection($subcategory)
                  ->transformWith(new SubCategoryTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $subcategory, 200, ['count' =>$total]);
}

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategory $request)
    {
        $data = $request->validated();
       
        $subcategory = SubCategory::create($data);

         if ($request->hasFile('image')) 
            {
                     $subcategory->addMedia($request->file('image'))
                     ->toMediaCollection('images');
            }
        $subcategory = fractal($subcategory,new SubCategoryTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

       return $this->responseApi(__('store subcategory successfully '), $subcategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = SubCategory::findOrfail($id);

        $subcategory = fractal()
                 ->item($subcategory)
                 ->transformWith(new SubCategoryTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$subcategory,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategory $request,string $id)
{
    $subcategory = SubCategory::findOrFail($id);

    $data = $request->validated();

    $subcategory->update($data);

    if ($request->hasFile('image')) {
        $subcategory->clearMediaCollection('images');

        $subcategory->addMedia($request->file('image'))
                    ->toMediaCollection('images');
    }

    $subcategory = fractal($subcategory, new SubCategoryTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('update subcategory successfully'), $subcategory, 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $subcategory = SubCategory::with('category')->findOrFail($id);

        if($subcategory)
        {
            return  $this->responseApi(__('can not delete'),403); 
        }

        $subcategory->delete();
        
        return  $this->responseApi(__('delete subcategory successfully'),204);
    }
}

