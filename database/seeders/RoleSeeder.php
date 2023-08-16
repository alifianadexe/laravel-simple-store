<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Administrator',
            ],
            [
                'name' => 'Staff',
            ],
            [
                'name' => 'Customer',
            ],
            [
                'name' => 'Super Admin',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
