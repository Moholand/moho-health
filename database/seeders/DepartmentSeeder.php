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
        $departments = [
            ['name' => 'بخش چشم ‌پزشکی', 'logo' => 'fas fa-glasses'],
            ['name' => 'بخش دندان ‌پزشکی', 'logo' => 'fas fa-tooth'],
            ['name' => 'بخش مغز و اعصاب', 'logo' => 'fas fa-brain'],
            ['name' => 'بخش جراحی', 'logo' => 'fa fa-user-md'],
            ['name' => 'بخش قلب', 'logo' => 'fa fa-heartbeat'],
            ['name' => 'بخش اطفال', 'logo' => 'fas fa-baby'],
        ];

        foreach($departments as $department) {
            $department = \App\Models\Department::factory()->create([
                'name' => $department['name'],
                'logo' => $department['logo']
            ]);

            // For each department create 10 doctors
            \App\Models\User::factory(10)->create([
                'role_id' => 2,
                'department_id' => $department->id
            ]);
        }
    }
}
