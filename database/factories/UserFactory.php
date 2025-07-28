<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(), // Crée une nouvelle entreprise ou utilise une existante
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // Mot de passe par défaut
            'phone' => $this->faker->phoneNumber(),
            'role' => $this->faker->randomElement(UserRoleEnum::cases()), // Sélectionne un rôle aléatoire de l'énumération
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRoleEnum::Admin,
        ]);
    }

    /**
     * Indicate that the user is staff.
     */
    public function staff(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRoleEnum::Staff,
        ]);
    }
}
