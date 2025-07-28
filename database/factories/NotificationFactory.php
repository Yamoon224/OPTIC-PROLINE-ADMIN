<?php

namespace Database\Factories;

use App\Models\{User, Company, Notification}; // Autre exemple de notifiable
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $notifiable = $this->faker->randomElement([
            User::factory()->create(),
            Company::factory()->create(),
        ]);

        return [
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable),
            'type' => $this->faker->randomElement([
                'OrderShipped', 'NewProduct', 'UserRegistered', 'PaymentReceived'
            ]),
            'data' => json_encode([
                'message' => $this->faker->sentence(),
                'details' => $this->faker->words(3, true)
            ]),
            'read_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 month', 'now'),
        ];
    }

}