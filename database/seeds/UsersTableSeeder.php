<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
            'personal_id' => Str::random(10),
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
        $user=User::find(1);
        $role=Role::find(1);
        $user->assignRole($role);

        // Create regular user
        DB::table('users')->insert([
            'personal_id' => Str::random(10),
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
        $user=User::find(2);
        $role=Role::find(2);
        $user->assignRole($role);


    }
}
