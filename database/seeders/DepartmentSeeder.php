<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departmentNames = [
            'بخش چشم ‌پزشکی', 
            'بخش دندان ‌پزشکی', 
            'بخش مغز و اعصاب',
            'بخش جراحی',
            'بخش قلب'
        ];

        foreach($departmentNames as $departmentName) {
            $department = \App\Models\Department::factory()->create([
                'name' => $departmentName
            ]);

            // For each department create 10 doctors
            \App\Models\User::factory(10)->create([
                'role_id' => 2,
                'department_id' => $department->id
            ]);
        }
    }
}
