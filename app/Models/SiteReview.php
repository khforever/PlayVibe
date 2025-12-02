<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class SiteReview extends Model
{
    use HasFactory ;
    protected $table = 'site_reviews';
    protected $fillable = [
        'user_id',
        'rating',
        'review',
        'is_approved',


    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
