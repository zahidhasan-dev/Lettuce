<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\ProductDiscount;
use Illuminate\Database\Seeder;
use App\Models\ProductMultiplePhoto;
use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $discounts = collect(Discount::where('status',1)->get())->map(function($discount){
                        return $discount->id;
                    })->toArray();

        $categories = collect(Category::all())->map(function($category){
                        return $category->id;
                    })->toArray();

        $size_array = ['ml','litre','gm','kg','lb','piece'];

        $sizeValueByScales = [
            'ml' => [
                'min' => 10,
                'max' => 1000,
            ],
            'litre' => [
                'min' => 1,
                'max' => 10,
            ],
            'gm' => [
                'min' => 10,
                'max' => 1000,
            ],
            'kg' => [
                'min' => 1,
                'max' => 10,
            ],
            'lb' => [
                'min' => 1,
                'max' => 15,
            ],
            'piece' => [
                'min' => 1,
                'max' => 12,
            ],
        ];

        $sizes = collect($size_array)->map(function($size){
                    return ProductSize::create(['scale_name' => $size, 'created_at' => now()]);
                 });

        $size_ids = [];

        foreach($sizes as $size){
            $size_ids[$size->scale_name] = $size->id;
        }


        for ($i=1; $i <= 15; $i++) { 
            
            $size_scale = $size_array[array_rand($size_array)];
            $sizeMin = $sizeValueByScales[$size_scale]['min'];
            $sizeMax = $sizeValueByScales[$size_scale]['max'];
            $size_value = rand($sizeMin, $sizeMax);

            $product_name = explode('.',$faker->sentence(2,false))[0];

            $slug = Str::slug($product_name,'-').'-'.$size_value.$size_scale.'-'.now()->timestamp;

            $product = Product::create([
                'product_name' => $product_name,
                'product_desc' =>  explode('.',$faker->sentence(6,false))[0],
                'price' => rand(1,10) * 100,
                'stock' => 100,
                'in_stock' => 100,
                'slug' => $slug,
                'has_discount' => rand(0,1),
                'is_featured' => rand(0,1),
                'status' => rand(0,1),
                'created_at' => now(),
            ]);

            $product->update(['thumbnail' => 'product_'.$product->id.'.jpg']);

            ProductMultiplePhoto::insert([
                'product_id' => $product->id,
                'multiple_photo' => 'product_'.$product->id.'_1.jpg',
                'created_at' => now(),
            ]);
            
            if($product->has_discount){

                ProductDiscount::insert([
                    'product_id' => $product->id,
                    'discount_id' => $discounts[array_rand($discounts)],
                ]);

            }
            
            $product->categories()->sync($categories[array_rand($categories)]);

            $product->size()->syncWithPivotValues($size_ids[$size_scale], ['size_value' => $size_value]);

        }

    }
}
