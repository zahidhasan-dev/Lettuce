<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('contact_addresses')->insert([
            [
                'contact_address' => $faker->address(),
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'contact_address' => $faker->address(),
                'is_active' => 0,
                'created_at' => now(),
            ]
        ]);


        DB::table('contact_emails')->insert([
            [
                'contact_email' => $faker->unique()->safeEmail(),
                'is_primary' => 1,
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'contact_email' => $faker->unique()->safeEmail(),
                'is_primary' => 0,
                'is_active' => 1,
                'created_at' => now(),
            ],
        ]);

        DB::table('contact_phones')->insert([
            [
                'contact_phone' => $faker->unique()->phoneNumber(),
                'is_primary' => 1,
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'contact_phone' => $faker->unique()->phoneNumber(),
                'is_primary' => 0,
                'is_active' => 1,
                'created_at' => now(),
            ],
        ]);
        
    }
}
