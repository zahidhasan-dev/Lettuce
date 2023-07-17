<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
                        'name' => 'Super-Admin',
                        'email' => 'super-admin@lettuce.com',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                        'is_admin' => 1,
                        'created_at' => now(),
                    ]);
        
        $super_admin->userDetails()->create([
            'user_id'=> $super_admin->id,
            'created_at'=> now(),
        ]);           

        $admin = User::create([
                        'name' => 'Admin',
                        'email' => 'admin@lettuce.com',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                        'is_admin' => 1,
                        'created_at' => now(),
                    ]);

        $admin->userDetails()->create([
            'user_id'=> $admin->id,
            'created_at'=> now(),
        ]);

        $manager = User::create([
                        'name' => 'Manager',
                        'email' => 'manager@lettuce.com',
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                        'is_admin' => 1,
                        'created_at' => now(),
                    ]);

        $manager->userDetails()->create([
            'user_id'=> $manager->id,
            'created_at'=> now(),
        ]);

        $super_admin->assignRole('super-admin');
        $admin->assignRole('admin');
        $manager->assignRole('manager');

        User::factory(10)->create()->each(function($user){
            $user->userDetails()->create([
                'user_id'=> $user->id,
                'created_at'=> now(),
            ]);
        });
        
    }
}
