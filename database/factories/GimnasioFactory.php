<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gimnasio>
 */
class GimnasioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'nombre' => $this->faker->company . ' Gym',
        'ubicacion' => $this->faker->address,
        'logo' => $this->faker->unique()->safeEmail,
        'celular' => $this->faker->phoneNumber,

        ];
    }
}
