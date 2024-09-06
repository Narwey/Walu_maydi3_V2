<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // This assumes users exist, or will create a new user if not
            'category_id' => Category::factory(), // This assumes categories exist
            'price' => $this->faker->randomFloat(2, 5, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['available', 'sold out']),
        ];
    }
}
