<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'g_name' => 'super_admin',
                'interface' => 'admin'
            ],
            [
                'name' => 'moderator',
                'g_name' => 'admin',
                'interface' => 'admin'
            ],
            [
                'name' => 'accountant',
                'g_name' => 'admin',
                'interface' => 'admin'
            ],
            [
                'name' => 'user',
                'g_name' => 'web',
                'interface' => 'web'
            ],


        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
