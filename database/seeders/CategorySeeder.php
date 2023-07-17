<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentCategories = [
            'fruits and vegetables' => 'category_1_1652462686.png',
            'fish and meat' => 'category_4_1652462562.png',
            'cooking' => 'category_7_1652462470.png',
            'dairy' => 'category_11_1652462789.png',
            'snacks' => 'category_14_1654169030.png',
        ];

        $subCategoriesByParent = [
            'fruits and vegetables' => [
                'fruits' => 'category_2_1652462711.png',
                'vegetables' => 'category_3_1652462727.png',
            ],
            'fish and meat' => [
                'fish' => 'category_5_1652462578.png',
                'meat' => 'category_6_1652462621.png',
            ],
            'cooking' => [
                'spices' => 'category_8_1652462517.png',
                'oil' => 'category_9_1652524856.png',
                'rice' => 'category_10_1653487025.png',
            ],
            'dairy' => [
                'milk' => 'category_12_1652462841.png',
                'eggs' => 'category_13_1652462877.png',
            ],
            'snacks' => [
                'chips' => 'category_15_1689203067.png',
            ],
        ];


        foreach ($parentCategories as $parent_name => $parent_image) {
            $parent_id = DB::table('categories')->insertGetId([
                'parent_category' => null,
                'category_name' => $parent_name,
                'category_slug' => Str::slug($parent_name, '-'),
                'category_photo' => $parent_image,
                'status' => 1,
                'created_at' => now(),
            ]);

            if(isset($subCategoriesByParent[$parent_name])){
                foreach ($subCategoriesByParent[$parent_name] as $name => $image) {
                    DB::table('categories')->insertGetId([
                        'parent_category' => $parent_id,
                        'category_name' => $name,
                        'category_slug' => Str::slug($name, '-'),
                        'category_photo' => $image,
                        'status' => 1,
                        'created_at' => now(),
                    ]);
                }
            }
        }

    }
}
