<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliderNames = [
            'اسلاید اول', 
            'اسلاید دوم', 
            'اسلاید سوم'
        ];

        foreach($sliderNames as $key => $sliderName) {
            Slider::create([
                'name' => $sliderName,
                'image' => (++$key) . '.jpg'
            ]);
        }
    }
}
