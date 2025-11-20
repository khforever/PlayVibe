<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\OrderStatus;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total', 'status', 'address'];

    // protected $casts = [ 'status' => OrderStatus::class, ]; // cast enum



    public function user() { return $this->belongsTo(User::class); }

    public function items() { return $this->hasMany(OrderItem::class); }

    public function payment() { return $this->hasOne(Payment::class); }
}
