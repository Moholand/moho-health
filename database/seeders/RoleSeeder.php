<?php

namespace Database\Seeders;

use App\Models\role;
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
        $roleNames = [
            'کاربر عادی', 
            'مدیر سایت', 
            'پزشک'
        ];

        foreach($roleNames as $key => $roleName) {
            role::create([
                'name' => $roleName
            ]);
        }
    }
}
