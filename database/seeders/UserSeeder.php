<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Admin',
            'email' => 'abdalkreemnofal09565@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
            'role' => 'admin',
        ]);
        $user->assignRole('admin'); // Assign the 'admin' role

        $user = User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
            'role' => 'admin',
        ]);
        $user->assignRole('admin'); // Assign the 'admin' role

        $user = User::create([
            'name' => 'Namaa',
            'email' => 'namaa@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
            'role' => 'user',
        ]);
        $user->assignRole('user'); // Assign the 'user' role


    }
}
