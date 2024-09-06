<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_id' => Order::factory(),
            'amount' => $this->faker->randomFloat(2, 5, 500),
            'payment_method' => $this->faker->randomElement(['cash', 'paypal', 'card']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}
