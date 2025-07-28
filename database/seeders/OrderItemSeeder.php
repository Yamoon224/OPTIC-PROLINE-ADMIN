<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{OrderItem, Order, Product, User, Category};

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous qu'il y a des commandes et des produits
        if (Order::count() === 0) {
            User::factory()->create(); // Crée un utilisateur si nécessaire
            Order::factory(5)->create();
        }
        if (Product::count() === 0) {
            Category::factory()->create(); // Crée une catégorie si nécessaire
            Product::factory(10)->create();
        }

        OrderItem::factory(50)->create();
    }
}
