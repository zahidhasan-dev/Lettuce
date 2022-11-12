<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;


    protected $fillable = [
        'about_sub_title',
        'about_title',
        'about_desc_1',
        'about_desc_2',
        'about_author_name',
        'about_author_title',
        'about_image',
        'is_active'
    ];


}
