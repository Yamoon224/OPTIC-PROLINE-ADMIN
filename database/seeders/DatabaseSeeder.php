<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\{User, Category, Product, Order, OrderItem, Payment, Notification};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer des entreprises
        Company::factory(5)->create()->each(function ($company) {
            // Créer des utilisateurs pour chaque entreprise
            User::factory(rand(2, 5))->for($company)->create();
        });

        // Créer des catégories
        Category::factory(10)->create();

        // Créer des produits, en s'assurant qu'ils sont liés à une catégorie existante
        Product::factory(50)->create();

        // Créer des commandes, en s'assurant qu'elles sont liées à un utilisateur existant
        Order::factory(20)->create()->each(function ($order) {
            // Créer des éléments de commande
            $items = OrderItem::factory(rand(1, 5))->for($order)->create([
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
        
            // Calculer le montant total de la commande
            $order->updateTotalAmount();

            Payment::factory(rand(1, 2))->for($order)->create([
                'amount' => $order->amount,
            ]);
        });

        // Créer des notifications (liées aléatoirement à des utilisateurs ou des entreprises)
        Notification::factory(30)->create();

        // Exemple de création d'un utilisateur admin spécifique
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'company_id' => Company::first()->id, // Assurez-vous qu'une entreprise existe
        ]);

        // Exemple de création d'un utilisateur staff spécifique
        User::factory()->staff()->create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'company_id' => Company::first()->id, // Assurez-vous qu'une entreprise existe
        ]);
    }
}