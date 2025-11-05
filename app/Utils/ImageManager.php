<?php
namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ImageManager
{
    public static function  uploadImage($request, $product,$paths)
    {
        if ($request->hasFile('images')) {
            foreach ($request->images as $index => $image) {
                $file = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
                $path = $paths . $file;
                  $image->move(public_path($paths), $file);
                $product->images()->create([
                    "image_url" => $path,
                    'is_main' => $index === 0,
                ]);
            }
        }
    }
    public static function deleteImages($product)
    {
        if ($product->images->count() > 0) {
            // حذف الصور المرتبطة بالبوست من الجدول
            foreach ($product->images as $image) {
                // لو الصور مخزنة على السيرفر كملفات:
                Self::deleteImage($image->path);
            }
        }
    }
    public static function  updateImage($request, $product, $paths)
    {   
       if ($request->hasFile('images')) {

    
        $images = $request->file('images');

        foreach ($images as $image) {
            $file = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
            $path = $paths.'/' . $file;

            $image->move(public_path($paths), $file);

            $isMain = !$product->images()->where('is_main', true)->exists();
            $product->images()->create([
                'image_url' => $path,
                'is_main' => $isMain,
            ]);
        }
    }
    }

    public static function deleteImage($image_path)
    {
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
    }
}