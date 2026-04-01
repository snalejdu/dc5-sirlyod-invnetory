<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(0, 1000),
            'location' => $this->faker->city(),
            'last_restocked' => $this->faker->date(),
            'reorder_level' => $this->faker->numberBetween(10, 50),
        ];
    }
}
