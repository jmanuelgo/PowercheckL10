<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $entrenadorRole = Role::create(['name' => 'entrenador']);
        $atletaRole = Role::create(['name' => 'atleta']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Juan',
                'apellidos' => 'Admin',
                'celular' => '000000000',
                'password' => bcrypt('admin123'),
            ]
        );
        $admin->assignRole($adminRole);
        
    }
}
