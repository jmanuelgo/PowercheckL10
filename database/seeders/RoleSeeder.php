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
        // Gimnasios
        Permission::create(['name'=> 'admin.gimnasios'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios.create'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios.edit'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.gimnasios.destroy'])->assignRole($adminRole);

        // Entrenadores
        Permission::create(['name'=> 'admin.entrenadores'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.entrenadores.create'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.entrenadores.edit'])->assignRole($adminRole);
        Permission::create(['name'=> 'admin.entrenadores.destroy'])->assignRole($adminRole);
        //asingar permisos al rol de entrenador
        Permission::create(['name' => 'entrenador.entrenadordashboard'])->assignRole($entrenadorRole);
        // Entrenador Atletas
        Permission::create(['name' => 'entrenador.atletas'])->assignRole($entrenadorRole);
        Permission::create(['name' => 'entrenador.atletas.create'])->assignRole($entrenadorRole);
        Permission::create(['name' => 'entrenador.atletas.edit'])->assignRole($entrenadorRole);
        Permission::create(['name' => 'entrenador.atletas.destroy'])->assignRole($entrenadorRole);

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
