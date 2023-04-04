<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'mobile' => '1234567890',
            'status' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = User::find(1);

        // Create regular user
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'bilal@gmail.com',
            'mobile' => '0987654321',
            'status' => 0,
            'email_verified_at' => null,
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = User::find(2);
    }
}
