<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sub_category_id',
    ];

    public function subCategory() { return $this->belongsTo(SubCategory::class); }

    public function images() { return $this->hasMany(ProductImage::class); }

    public function variants() { return $this->hasMany(ProductVariant::class); }

    public function attributes() { return $this->hasOne(Attribute::class); }

    public function reviews() { return $this->hasMany(Review::class); }

    public function favourites() { return $this->hasMany(Favourite::class); }
}
