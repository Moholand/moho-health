<?php

namespace Database\Seeders;

use App\Models\Role;
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

        $schedule = [
            ['day' => 'شنبه', 'hour' => '8-10'],
            ['day' => 'شنبه', 'hour' => '15-17'],
            ['day' => 'سه‌شنبه', 'hour' => '13-15'],
            ['day' => 'پنج‌شنبه', 'hour' => '10-12']
        ];

        foreach($departments as $department) {
            $department = \App\Models\Department::factory()->create([
                'name' => $department['name'],
                'logo' => $department['logo']
            ]);

            // For each department create 10 doctors
            \App\Models\User::factory(10)->create([
                'role_id' => Role::DOCTOR,
                'department_id' => $department->id,
                'schedule' => json_encode($schedule)
            ]);
        }
    }
}
