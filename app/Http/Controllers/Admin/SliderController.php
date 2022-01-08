<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Resources\HomeSliderResource;
use App\Http\Requests\AdminCreateSliderRequest;

class SliderController extends Controller
{
    public function index()
    {
       return HomeSliderResource::collection(Slider::all());
    }

    public function store(AdminCreateSliderRequest $request)
    {
        $slider = new Slider;
        $slider->name = $request->name;

        $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
        $request->file('image')->storeAs('sliders', $imageName);
        $slider->image = $imageName;

        $slider->save();

        return response()->json([
            'newSlider' => $slider,
            'message' => 'اطلاعات شما با موفقیت ذخیره شدند'
        ], 200);
    }

    public function update(Request $request, $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        $slider->name = $request->name;
        $slider->save();

        return response()->json([
            'slider' => $slider,
            'message' => 'اطلاعات شما با موفقیت ویرایش شد'
        ], 200);
    }

    public function destroy(Slider $slider)
    {
        // Delete image of slider from public folder
        File::delete(public_path('images/sliders') . '/' . $slider->image);
        // Delete row from table
        $slider->delete();

        return response()->json([
            'message' => 'اسلاید مورد نظر با موفقیت حذف شد',
            'sliders' => Slider::all()
        ], 200);
    }
}
