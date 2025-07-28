<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Enums\ProductStatusEnum;
use App\Enums\ProductGenderEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true) . ' ' . $this->faker->unique()->randomNumber(4),
            'description' => $this->faker->paragraph(),
            'unit_price' => $this->faker->randomFloat(2, 10, 1000),
            'batch_price' => $this->faker->optional(0.5)->randomFloat(2, 500, 5000),
            'stock_quantity' => $this->faker->numberBetween(0, 500),
            'status' => $this->faker->randomElement(ProductStatusEnum::cases()),
            'brand' => $this->faker->company(),
            'material' => $this->faker->randomElement(['Plastique', 'Métal', 'Bois', 'Tissu', 'Verre']),
            'gender' => $this->faker->optional(0.8)->randomElement(ProductGenderEnum::cases()),
            'shape' => $this->faker->randomElement(['Rond', 'Carré', 'Ovale', 'Rectangulaire', 'Cœur']),
            'color' => $this->faker->colorName(),
            'category_id' => Category::factory(), // Crée une nouvelle catégorie ou utilise une existante
        ];
    }
}
