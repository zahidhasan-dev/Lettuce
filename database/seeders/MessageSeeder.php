<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Message::factory(10)->create();

        DB::table('messages')->insert([
            [
                'message_id' => rand(1,10),
                'name' => 'Lettuce Support',
                'email' => 'support@lettuce.com',
                'message' => $faker->paragraph(),
                'is_read' => 1,
                'created_at' => now(),
            ],
            [
                'message_id' => rand(1,10),
                'name' => 'Lettuce Support',
                'email' => 'support@lettuce.com',
                'message' => $faker->paragraph(),
                'is_read' => 1,
                'created_at' => now(),
            ],
        ]);
        
    }
}
