<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;


    protected $fillable = ['discount_name','discount_value','discount_type','discount_slug','discount_validity'];

    
}
