<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];



    function order_user()
    {
        return $this->belongsTo(User::class);
    }


    function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function scopeToday($query)
    {
       return $query->whereDate('created_at', Carbon::today());
    }


    public function scopeYesterday($query)
    {
       return $query->whereDate('created_at', Carbon::yesterday());
    }


    public function scopeWeekly($query, $from, $to)
    {
       return $query->whereBetween('created_at',[$from, $to]);
    }


    public function scopeMonthly($query, $from , $to)
    {
       return $query->whereBetween('created_at',[$from, $to]);
    }


    public function scopeYearly($query, $from , $to)
    {
       return $query->whereBetween('created_at',[$from, $to]);
    }


    public function scopeCountTotal($query)
    {
        return $query->select(DB::raw('COUNT(*) as orders_count, SUM(order_total) as revenue'))->first();
    }

    
}
