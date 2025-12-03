<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   protected $fillable = [
        'user_id', 'full_name', 'email', 'phone',
        'address', 'city', 'delivery_option', 'delivery_price',
        'notes', 'payment_method', 'location_lat', 'location_lng',
        'subtotal', 'status'
    ];

    public const PENDING = 1;

 public const CANCELLED = 2;

 public const DELIVERD = 3;


  public const STANDEARD =1;
  public const ECO = 2;
   public const SAME_DAY = 3;

   public const CASH = 1;




  public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items() { return $this->hasMany(OrderItem::class); }

    public function payment() { return $this->hasOne(Payment::class); }
}
