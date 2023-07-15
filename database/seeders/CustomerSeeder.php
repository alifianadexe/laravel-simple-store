<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach (range(1, 20) as $i) {
            $user = \App\Models\User::create([
                'name' => fake()->name,
                'sex' => fake()->randomElement(['Male', 'Female']),
                'username' => 'customer' . $i,
                'password' => bcrypt('customer' . $i),
                'role_id' => 3,
            ]);

            $user->customer()->create([
                'address' => fake('id_ID')->address,
                'born_place' => fake('id_ID')->city,
                'born_date' => fake('id_ID')->date,
                'id_card_photo' => 'id_cards/' . $user->username . '.png',
            ]);
        }
    }
}
