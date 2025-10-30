<?php

namespace App\Traits;

trait UploadImageTrait
{
    public static function uploadImage($request, string $path):string

    {
           $image=$request->file('image');
           $imageName=$image->getClientOriginalName();
           $image->move($path, $imageName);
                return $imageName;
    }


    public static function DeleteImage(string $path):bool{

        $oldFilePath=public_path($path);

            if(file_exists($oldFilePath)){
                unlink($oldFilePath);
                return true;
              }
              return false;
        }
}
