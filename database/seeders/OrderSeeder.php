<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Order, User, Product, Company, Category, OrderItem, Payment}; // Pour les OrderItems

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous qu'il y a des utilisateurs pour lier les commandes
        if (User::count() === 0) {
            // Créez une entreprise et un utilisateur si aucun n'existe
            Company::factory()->create();
            User::factory(5)->create();
        }
        // Assurez-vous qu'il y a des produits pour les OrderItems
        if (Product::count() === 0) {
            Category::factory()->create();
            Product::factory(10)->create();
        }

        Order::factory(30)->create()->each(function ($order) {
            // Créer 1 à 5 éléments de commande pour chaque commande
            OrderItem::factory(rand(1, 5))->create([
                'order_id' => $order->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
            // Créer 1 à 2 paiements pour chaque commande
            Payment::factory(rand(1, 2))->create([
                'order_id' => $order->id,
                'amount' => $order->total_amount,
            ]);
        });
    }
}