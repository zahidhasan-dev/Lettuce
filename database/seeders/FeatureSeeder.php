<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('features')->insert([
            [
                'feature_title' => $faker->sentence(3, false),
                'feature_desc' => $faker->text(100),
                'feature_image' => 'feature_1_166496940533.png',
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'feature_title' => $faker->sentence(3, false),
                'feature_desc' => $faker->text(100),
                'feature_image' => 'feature_2_166496943015.png',
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'feature_title' => $faker->sentence(3, false),
                'feature_desc' => $faker->text(100),
                'feature_image' => 'feature_3_166496945794.png',
                'is_active' => 1,
                'created_at' => now(),
            ],
        ]);

    }
}
