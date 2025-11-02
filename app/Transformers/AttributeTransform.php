<?php

namespace App\Transformers;

use App\Models\Attribute;
use League\Fractal\TransformerAbstract;

class AttributeTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Attribute $attribute):array
    {
        return [
             'product_id'=>$attribute->product_id,
             'sumthumb'=>$attribute->sumthumb,
             'additional_info'=>$attribute->additional_info,
             'dimension'=>$attribute->dimension,
             'maincompartment'=>$attribute->maincompartment,
             'durable_fabric'=>$attribute->durable_fabric,
             'spacious'=>$attribute->spacious,
        ];
    }
}
