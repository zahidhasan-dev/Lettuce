<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','product_id','user_name','user_email','review_rating','review_feedback','created_at'];


    public function review_product()
    {
        return $this->belongsTo(Product::class);
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
