<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'detail_orders_id' => rand(1, 2),
            'menu_id' => rand(1, 5),
            'meja_id' => rand(1, 5),
            'qty' => rand(1, 4),
        ];
    }
}
