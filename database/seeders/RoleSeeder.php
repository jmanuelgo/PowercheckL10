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

        Permission::create(['name' => 'admin.admindashboard'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios.create'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios.edit'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios.destroy'])->assignRole($adminRole);

        // Entrenadores
        Permission::create(['name'=> 'admin.entrenadores'])->assignRole($adminRole);


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
