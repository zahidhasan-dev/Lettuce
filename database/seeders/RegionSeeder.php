<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citiesByCountry = [
            'australia' => [
                'melbourne',
                'sydney',
            ],
            'bangladesh' => [
                'chittagong',
                'barisal',
                'dhaka',
                'khulna',
                'mymensingh',
                'rajshahi',
                'sylhet',
            ],
            'canada' => [
                'alberta',
                'british columbia',
                'ontario',
            ],
        ];

        foreach ($citiesByCountry as $country => $cities) {
            $countryId = DB::table('countries')->insertGetId([
                'country_name' => $country,
                'created_at' => now(),
            ]);

            foreach ($cities as $city) {
                DB::table('cities')->insert([
                    'country_id' => $countryId,
                    'city_name' => $city,
                    'created_at' => now(),
                ]);
            }
        }

    }
}
