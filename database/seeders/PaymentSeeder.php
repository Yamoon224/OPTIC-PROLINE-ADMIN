<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Payment, Order, User};

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous qu'il y a des commandes pour lier les paiements
        if (Order::count() === 0) {
            User::factory()->create(); // Crée un utilisateur si nécessaire
            Order::factory(5)->create();
        }

        Payment::factory(40)->create();
    }
}