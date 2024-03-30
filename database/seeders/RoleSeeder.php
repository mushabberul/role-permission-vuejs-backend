<?php

namespace Database\Seeders;

use App\Models\Backend\Permission;
use Illuminate\Support\Str;
use App\Models\Backend\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::get()->pluck(['id']);
        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin'
        ])->permissions()->sync($permissions);

        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user'
        ]);
        Role::updateOrCreate([
            'role_name' => 'Manager',
            'role_slug' => 'manager'
        ]);
    }
}
