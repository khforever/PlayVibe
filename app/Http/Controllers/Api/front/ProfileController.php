<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use Common;

    public function updateprofile(Request $request)
    {
         $user = $request->user();

        $data = $request->validate([
             'first_name' => 'sometimes|string|max:255',
            'last_name'  => 'sometimes|string|max:255',
            'phone'      => 'sometimes|string',
            'address'    => 'sometimes|string|max:255',
            'city'       => 'sometimes|string|max:255',
            'email'      => 'sometimes|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|string|min:6',
            'image'      => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        if($request->hasfile('image'))
        {
        $data['image'] = $this->uploadFile($request->image,'assets/images');
        
        }

       if ($request->password)
         {
        $data['password'] = Hash::make($request->password);
    } else {
        unset($data['password']);
    }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);

    }
}
