<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Administrator 1',
                'role_id' => 1,
                'sex' => 'Male',
                'username' => 'admin',
                'password' => bcrypt('admin')
            ],
            [
                'name' => 'Administrator 2',
                'role_id' => 1,
                'sex' => 'Female',
                'username' => 'admin2',
                'password' => bcrypt('admin2')
            ],
            [
                'name' => 'Super Admin',
                'role_id' => 4,
                'sex' => 'Female',
                'username' => 'superadmin',
                'password' => bcrypt('admin')
            ],
            [
                'name' => 'Staff 1',
                'role_id' => 2,
                'sex' => 'Male',
                'username' => 'staff',
                'password' => bcrypt('staff')
            ],
            [
                'name' => 'Staff 2',
                'role_id' => 2,
                'sex' => 'Female',
                'username' => 'staff2',
                'password' => bcrypt('staff2')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
