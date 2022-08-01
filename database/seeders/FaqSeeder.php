<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

       for($i=1;$i<=10;$i++){
            DB::table('faqs')->insert([
                'faq_ques'=>$faker->sentence,
                'faq_ans'=>$faker->text(),
                'is_active'=>rand(0,1),
                'created_at'=>now(),
            ]);
       }
    }
}
