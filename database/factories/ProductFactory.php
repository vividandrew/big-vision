<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'Barcode' => $this->faker->word(),
            'Price' => $this->faker->randomFloat(),
            'Stock' => $this->faker->randomNumber(),
            'Name' => $this->faker->name(),
            'Description' => $this->faker->text(),
            'Platform' => $this->faker->word(),
            'GroupId' => $this->faker->randomNumber(),
            'Discount' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
