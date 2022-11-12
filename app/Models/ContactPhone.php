<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    use HasFactory;

    protected $fillable = ['contact_phone','is_primary','is_active','created_at'];

}
