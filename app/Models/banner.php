<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;


    protected $fillable = ['banner_type','banner_title','banner_button','banner_slug','category_id','discount_id','banner_image','status'];



    public function discount()
    {
        return $this->belongsTo(Discount::class,'discount_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
