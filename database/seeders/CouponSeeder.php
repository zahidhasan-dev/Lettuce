<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
                'coupon_code' => 'LETTUCE10',
                'coupon_type' => 'fixed',
                'coupon_value' => '1000',
                'coupon_validity' => now()->addDays(10),
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'coupon_code' => 'LETTUCE15',
                'coupon_type' => 'percent',
                'coupon_value' => '15',
                'coupon_validity' => now()->subDays(3),
                'status' => 0,
                'created_at' => now(),
            ],
        ]);
    }
}
