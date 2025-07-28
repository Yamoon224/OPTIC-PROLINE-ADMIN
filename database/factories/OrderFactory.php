<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Enums\PaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Crée un nouvel utilisateur ou utilise un existant
            'amount' => $this->faker->randomFloat(2, 50, 5000),
            'discount' => $this->faker->optional(0.3)->randomFloat(2, 0, 100),
            'payment_status' => $this->faker->randomElement(PaymentStatusEnum::cases()),
            'order_status' => $this->faker->randomElement(OrderStatusEnum::cases()),
            'delivery_address' => $this->faker->address(),
            'billing_address' => $this->faker->optional(0.7)->address(),
        ];
    }
}