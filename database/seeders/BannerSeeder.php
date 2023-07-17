<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('banners')->insert([
            [
                'banner_type' => 'hero',
                'banner_sub_title' => 'welcome to our shop',
                'banner_title' => 'tasty & healthy organic food',
                'banner_button' => 'shop now',
                'category_id' => null,
                'discount_id' => null,
                'banner_slug' => null,
                'banner_image' => 'banner_hero_1_166472469463.jpg',
                'status' => 1,
                'url' => '/shop',
                'created_at' => now(),
            ],
            [
                'banner_type' => 'hero',
                'banner_sub_title' => $faker->sentence(4, false),
                'banner_title' => $faker->sentence(5, false),
                'banner_button' => 'shop now',
                'category_id' => 2,
                'discount_id' => null,
                'banner_slug' => 'fruits-and-vegetables/fruits',
                'banner_image' => 'banner_hero_2_166538758817.jpg',
                'status' => 1,
                'url' => '/shop/fruits-and-vegetables/fruits',
                'created_at' => now(),
            ],
            [
                'banner_type' => 'campaign',
                'banner_sub_title' => null,
                'banner_title' => null,
                'banner_button' => null,
                'category_id' => 3,
                'discount_id' => null,
                'banner_slug' => 'fruits-and-vegetables/vegetables',
                'banner_image' => 'banner_campaign_3_166472433593.jpg',
                'status' => 1,
                'url' => '/shop/fruits-and-vegetables/vegetables',
                'created_at' => now(),
            ],
            [
                'banner_type' => 'campaign',
                'banner_sub_title' => null,
                'banner_title' => null,
                'banner_button' => null,
                'category_id' => 2,
                'discount_id' => 1,
                'banner_slug' => 'vegetables-summer-sale',
                'banner_image' => 'banner_campaign_4_166469187820.jpg',
                'status' => 1,
                'url' => '/sale/vegetables-summer-sale',
                'created_at' => now(),
            ],
            [
                'banner_type' => 'campaign',
                'banner_sub_title' => null,
                'banner_title' => null,
                'banner_button' => null,
                'category_id' => null,
                'discount_id' => 2,
                'banner_slug' => 'clearance-sale',
                'banner_image' => 'banner_campaign_5_166472496248.jpg',
                'status' => 1,
                'url' => '/sale/clearance-sale',
                'created_at' => now(),
            ],
        ]);
        
    }
}
