<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            AboutSeeder::class,
            CategorySeeder::class,
            ContactSeeder::class,
            CouponSeeder::class,
            DiscountSeeder::class,
            BannerSeeder::class,
            FaqSeeder::class,
            FeatureSeeder::class,
            LogoSeeder::class,
            MessageSeeder::class,
            ProductSeeder::class,
            RegionSeeder::class,
            SubscriberSeeder::class,
            OrderSeeder::class,
        ]);
    }
}

