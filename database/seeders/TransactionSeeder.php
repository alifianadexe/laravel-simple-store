<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        foreach (Customer::all() as $customer) {
            foreach (range(1, rand(2, 15)) as $i) {

                $selected_products = $products->shuffle()->slice(0, fake()->numberBetween(1, 5))->mapWithKeys(function($product) {
                    $quantity = fake()->numberBetween(1, 5);
                    return [$product->id => [
                        'quantity' => $quantity,
                        'total' => $quantity * $product->sell_price,
                    ]];
                });

                $transaction = $customer->transactions()->create([
                    'code' => strtoupper(uniqid()),
                    'status' => 'success',
                    'total' => $selected_products->reduce(function($carry, $product) {
                        $carry += $product['total'];
                        return $carry;
                    }, 0),
                    'approved_by' => fake()->randomElement([3, 4]),
                    'created_at' => fake()->dateTimeBetween('-30 days'),
                ]);

                $transaction->products()->sync($selected_products);

            }
        }
    }
}
