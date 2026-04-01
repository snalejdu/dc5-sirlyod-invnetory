<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
{
    return [
        'name'        => fake()->words(3, true),
        'sku'         => strtoupper(fake()->unique()->bothify('SKU-####-????')),
        'description' => fake()->paragraph(),
        'price'       => fake()->randomFloat(2, 10, 1000),
        // Use an existing supplier instead of creating a new one each time
        'supplier_id' => \App\Models\Supplier::inRandomOrder()->first()?->id
                         ?? \App\Models\Supplier::factory(),
    ];
}
}
