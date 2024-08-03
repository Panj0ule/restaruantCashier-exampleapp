<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Item::factory(10)->create();

        // Seed transactions
        Transaction::factory()->count(5)->create()->each(function ($transaction) {
            // Select random items
            $items = Item::inRandomOrder()->take(3)->get();

            $totalPrice = 0;

            foreach ($items as $item) {
                $quantity = rand(1, 5);
                $itemPrice = $item->price;
                $totalPrice += $quantity * $itemPrice;

                // Attach items to the transaction with quantity and item price
                $transaction->items()->create([
                    'item_id' => $item->id,
                    'quantity' => $quantity,
                    'item_price' => $itemPrice,
                ]);
            }

            // Update the transaction with the calculated total price
            $transaction->update(['total_price' => $totalPrice]);
        });

        User::factory()->create([
            'name' => 'Dummy Admin',
            'email' => 'dummyadmin@example.com',
            'password' => bcrypt('123456'),
            'is_admin' => true
        ]);
        User::factory()->create([
            'name' => 'Dummy Pegawai',
            'email' => 'dummypegawai@example.com',
            'password' => bcrypt('123456'),
            'is_admin' => false
        ]);
    }
}

