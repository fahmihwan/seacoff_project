<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement(['latte', 'cappucino', 'americano', 'espresso', 'mocha']),
            'kategori' => $this->faker->randomElement(['hot', 'ice', 'snack', 'food']),
            'harga' => $this->faker->randomElement([8000, 14000, 17000, 20000, 21000, 3000]),
            'gambar' => '',
            'status' => 'tersedia',
        ];
    }
}
