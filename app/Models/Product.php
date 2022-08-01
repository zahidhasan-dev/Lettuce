<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'product_desc',
        'price',
        'stock',
        'in_stock',
        'thumbnail',
        'slug',
        'has_discount',
        'is_featured',
        'status',
        'created_at'
    ];


    public function size()
    {
        // return $this->belongsTo(ProductSize::class)->withPivot('size_value');
        return $this->belongsToMany(ProductSize::class)->withPivot('size_value');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function multiple_photos()
    {
        return $this->hasMany(ProductMultiplePhoto::class);
    }
    
    
    public function product_discount()
    {
        return $this->hasOne(ProductDiscount::class);
    }
    
    
    // public function discount()
    // {
    //     return $this->hasOneThrough(Discount::class, ProductDiscount::class, 'product_id','id','id','discount_id');
    // }


    public function product_views()
    {
        return $this->hasMany(ProductView::class);
    }


    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }



    public function product_orders()
    {
        return $this->hasMany(OrderItem::class);
    }

}
