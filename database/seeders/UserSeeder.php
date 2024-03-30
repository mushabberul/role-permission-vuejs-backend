<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        User::updateOrCreate([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        User::updateOrCreate([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
        User::updateOrCreate([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
        User::updateOrCreate([
            'name' => 'manager1',
            'email' => 'manager1@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3
        ]);
        User::updateOrCreate([
            'name' => 'manager2',
            'email' => 'manager2@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3
        ]);
    }
}
