<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('discounts')->insert([
            [
                'discount_name' => 'summer sale',
                'discount_type' => 'fixed',
                'discount_value' => '150',
                'discount_slug' => 'summer-sale',
                'discount_validity' => now()->addDays(10),
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'discount_name' => 'clearance sale',
                'discount_type' => 'percent',
                'discount_value' => '15',
                'discount_slug' => 'clearance-sale',
                'discount_validity' => now()->addDays(7),
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'discount_name' => 'flash sale',
                'discount_type' => 'percent',
                'discount_value' => '20',
                'discount_slug' => 'flash-sale',
                'discount_validity' => now()->addDays(3),
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'discount_name' => 'winter sale',
                'discount_type' => 'fixed',
                'discount_value' => '50',
                'discount_slug' => 'winter-sale',
                'discount_validity' => now()->addDays(15),
                'status' => 0,
                'created_at' => now(),
            ],
        ]);

    }
}
