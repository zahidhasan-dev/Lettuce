<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['parent_category','category_name','category_slug','category_photo'];



    public function main_category()
    {
        return $this->belongsTo(Category::class,'parent_category');
    }


    public function sub_category()
    {
        return $this->hasMany(Category::class,'parent_category');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    

}
