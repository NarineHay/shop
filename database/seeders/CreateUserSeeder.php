<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@test.am')->first();

        if (!$user) {
            $user = User::updateOrCreate(
                ['email' => 'admin@admin.am'],
                [
                    'name' => 'Admin',
                    'status' => 1,
                    'password' => bcrypt('123456')
                ]
            );

            $role = Role::updateOrCreate(['name' => 'super_admin'], ['g_name' => 'super_admin', 'interface' => 'admin']);

            $permissions = Permission::pluck('id', 'id')->all();

            $role->syncPermissions($permissions);

            $user->assignRole([$role->id]);
        }

    }
}
