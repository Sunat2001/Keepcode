<?php

namespace Database\Factories;

use App\Enum\ProductRentStatuses;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentProduct>
 */
class RentProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(ProductRentStatuses::getValues()),
            'user_id' => User::all()->random()->first()->id,
            'product_id' => Product::all()->random()->first()->id,
        ];
    }
}
