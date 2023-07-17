<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('abouts')->insert([
            [
                'about_sub_title' => $faker->sentence(4, false),
                'about_title' => $faker->sentence(4, false),
                'about_desc_1' => $faker->paragraph(),
                'about_desc_2' => $faker->paragraph(),
                'about_author_name' => $faker->name(),
                'about_author_title' => 'CEO',
                'about_image' => 'about_1_166495009012.png',
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'about_sub_title' => $faker->sentence(4, false),
                'about_title' => $faker->sentence(4, false),
                'about_desc_1' => $faker->paragraph(),
                'about_desc_2' => $faker->paragraph(),
                'about_author_name' => $faker->name(),
                'about_author_title' => 'CEO',
                'about_image' => 'about_2_166494832216.png',
                'is_active' => 0,
                'created_at' => now(),
            ],
        ]);

    }
}
