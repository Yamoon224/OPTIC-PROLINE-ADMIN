<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Order;
use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(), // Crée une nouvelle commande ou utilise une existante
            'amount' => $this->faker->randomFloat(2, 100, 3000),
            'payment_method' => $this->faker->randomElement(PaymentMethodEnum::cases())->value,
            'transaction_id' => $this->faker->uuid(),
            'operator_id' => $this->faker->optional(0.5)->word(),
            'currency' => 'XOF', // Valeur par défaut de la migration
            'payment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}