<?php

namespace App\Transformers;

use App\Models\SubCategory;
use League\Fractal\TransformerAbstract;

class SubCategoryTransform extends TransformerAbstract
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
    public function transform(SubCategory $subCategory):array
    {
        return [
            'name'=>$subCategory->name,
            'category_id'=>$subCategory->category_id,
             'image' => $subCategory->getFirstMediaUrl('images') ?: null,
        ];
    }
}
