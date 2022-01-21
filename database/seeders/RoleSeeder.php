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
            'مدیر سایت', 
            'پزشک',
            'کاربر عادی'
        ];

        foreach($roleNames as $key => $roleName) {
            role::create([
                'name' => $roleName
            ]);
        }
    }
}
