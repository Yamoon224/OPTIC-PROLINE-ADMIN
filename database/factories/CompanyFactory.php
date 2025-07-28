<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'register_id' => $this->faker->unique()->uuid(), // Données factices pour le nouvel ID d'enregistrement
            'address' => $this->faker->address(),             // Données factices pour l'adresse
            'contact' => $this->faker->phoneNumber(),         // Données factices pour le contact
        ];
    }
}