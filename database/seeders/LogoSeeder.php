<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageByType = [
            'light' => 'logo-light-1689249703.png',
            'dark' => 'logo-dark-1689250089.png',
            'mobile' => 'logo-mobile-1689241016.png',
            'favicon' => 'logo-favicon-1689273742.png',
        ];

        foreach ($imageByType as $type => $image) {
            DB::table('logos')->insert([
                'type' => $type,
                'image' => $image,
                'created_at' => now(),
            ]);
        }

    }
}
