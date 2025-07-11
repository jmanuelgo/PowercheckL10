<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gimnasio;
use Illuminate\Database\Seeder;
use App\Models\User;
use Laravel\Jetstream\Rules\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
        RoleSeeder::class,
        GimnasioSeeder::class,
    ]);

    }
}
