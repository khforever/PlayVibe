<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;
    use InteractsWithMedia;
     use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
      'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'image',
        'is_verified',
        'user_type',
    ];









   // أو بطريقة Laravel 11 الحديثة
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . ' ' . $this->last_name,
        );
    }










    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 public function otps()
 { return $this->hasMany(Otp::class);
  }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orders()
     {
        return $this->hasMany(Order::class);
    }
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
     }
    public function reviews()
    {
         return $this->hasMany(Review::class);
        }
    public function contacts()
    {
         return $this->hasMany(Contact::class);
         }
}
