<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAttribute;
use App\Http\Requests\Api\UpdateAttribute;
use App\Models\Attribute;
use App\Traits\Response;
use App\Transformers\AttributeTransform;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class AttributeController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     $search = $request->input('search');
    $take = $request->input('take'); 
    $skip = $request->input('skip');  
    
    $query = Attribute::query();

      if ($search)
    {
        $query->where('name','like', '%' . $search . '%');
    }

    $total = $query->count();

    $attribute = $query->skip($skip ?? 0)->take($take ?? $total)->get();

     $attribute =  fractal()->collection($attribute)
                  ->transformWith(new AttributeTransform())
                   ->serializeWith(new ArraySerializer())
                   ->toArray();

    return $this->responseApi('', $attribute, 200, ['count' =>$total]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttribute $request)
    {
         $data = $request->validated();
        
         $attribute = Attribute::create($data);

          $attribute = fractal($attribute,new AttributeTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

          return $this->responseApi(__('store attribute successfully '), $attribute, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attribute = Attribute::findOrfail($id);

        $attribute = fractal()
                 ->item($attribute)
                 ->transformWith(new AttributeTransform())
                 ->serializeWith(new ArraySerializer())
                 ->toArray();

        return  $this->responseApi('',$attribute,200);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttribute $request, string $id)
    {
         $data = $request->validated();

         $attribute = Attribute::findOrFail($id);
        
         Attribute::update($data);
        
        $attribute = fractal($attribute, new AttributeTransform())
                    ->serializeWith(new ArraySerializer())
                    ->toArray();

    return $this->responseApi(__('update attribute successfully'), $attribute, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $attribute = Attribute::with('product')->findOrFail($id);

        if($attribute)
        {
            return  $this->responseApi(__('can not delete'),403); 
        }

        $attribute->delete();
        
        return  $this->responseApi(__('delete attribute successfully'),204);
        
    }
}
