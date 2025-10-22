<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ResetPassword;
use App\Http\Requests\Api\SendOtp;
use App\Http\Requests\Api\VerifyEmailOtp;
use App\Models\Otp;
use App\Models\User;
use App\Traits\Common;
use App\Traits\Response;
use App\Transformers\UserTransform;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Serializer\ArraySerializer;

class AuthController extends Controller
{
    use Response;
    use Common;

    public function register(RegisterRequest $request)
    {
    $data = $request->validated();

    if($request->hasfile('image'))
        {
        $data['image'] = $this->uploadFile($request->image,'assets/images');
        
        }
 
     $data['password'] = Hash::make($data['password']);  

     $user = User::create($data);

     return $this->responseApi(__('register successfully'),$user,201);

    }

//login
public function login(LoginRequest $request)
{
    $data = $request->validated();

   $user = User::withTrashed()
                ->where('email',$data['email'])
                ->first();

   if(!$user || !Hash::check($data['password'],$user->password ))
   {
    return $this->responseApi(__('invalid credintials'));
   }
   if ($user->trashed()) 
   {
    return $this->responseApi(__('account is deleted'));
   }

if ($user->is_verified !== 1) 
{
    return $this->responseApi(__('user must be verify'));
}
   $token = $user->createToken('auth_token')->plainTextToken;

    $user = fractal()
                 ->item($user)
                 ->transformWith(new UserTransform())
                  ->serializeWith(new ArraySerializer())
                 ->toArray();

   return $this->responseApi(__('user login successfully'),$user,200,['token'=>$token]);

}

//logout
public function logout(Request $request)
{
    $logout = $request->input('logout');

    if($logout == 'one device' || !$logout)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->responseApi(__('logout one device'));
    }
    elseif($logout == 'all devices')
    {
        $request->user()->tokens()->delete();
        return $this->responseApi(__(' logout from all devices'));
    }  
      
}


//send otp
    public function sendotp(SendOtp $request)
    {
        $request->validated();

        $usage = $request->input('usage');

        $user = User::where('email', $request->email)->first();

        if (!$user) 
        {
            return $this->responseApi(__('user not_found'),404);
        }
 
        $otp = rand(1000, 9999);

        $otp = Otp::create([
           'user_id'=> $user->id,
           'otp'=> $otp,
           'expires_at'=> Carbon::now()->addMinutes(3),
           'usage'=>$usage,
        ]);
  
        return $this->responseApi(__('sendotp send'), 200);
    }

    
public function verifyEmailOtp(VerifyEmailOtp $request)
{
   $request->validated();

    $user = User::withTrashed()
                  ->where('email', $request->email)
                  ->first();

    if (!$user) 
    {
        return $this->responseApi(__('account not found'), 404);
    }

    if ($user->trashed())
     {
        return $this->responseApi(__('account is deleted'), 403);
    }

    $otp = $user->otps()
                ->where('otp', $request->otp)
                ->where('expired_at','>=',now())
                ->first();

    if(!$otp)
    {
        return $this->responseApi(__('invalid otp'),400);   
    }

        $user->update(['is_verified'=>true]);
       
        $otp->update(['usage' => 'verify']);
     
     return $this->responseApi(__('verify email successfully'), 200);
     
}


//reset password
public function resetpassword(ResetPassword $request)
{
    $request->validated();

    $user = User::withTrashed()
                 ->where('email', $request->email)
                 ->first();

    if (!$user) 
    {
        return $this->responseApi(__('user not found'),404);
    }

    if ($user->trashed()) 
    {
        return $this->responseApi(__('account is deleted'), 403);
    }

    $otp = Otp::where('user_id', $user->id)
              ->where('otp', $request->otp)
              ->where('expired_at', '>=', now())
              ->first();

    if (!$otp) 
    {
        return $this->responseApi(__('invalid otp'), 404);
    }

    if (!Hash::check($request->old_password, $user->password)) {
        return $this->responseApi(__('messages.old_password'), 422);
    }

    if (Hash::check($request->new_password, $user->password)) {
        return $this->responseApi(__('messages.current_password'));
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    $user->save();

    $otp->update(['usage' => 'forget']);

    return $this->responseApi(__('change password successfully'), 200);
}





}
