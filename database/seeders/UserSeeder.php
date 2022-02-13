<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'ادمین',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('ح'),
            'role_id' => 1
        ]);

        // Normal users
        \App\Models\User::factory(50)->create([
            'role_id' => 3,
        ]);
    }
}
