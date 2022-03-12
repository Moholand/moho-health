<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Appointment\StoreAppointmentRequest;

class AppointmentController extends Controller
{
    public function store(StoreAppointmentRequest $request)
    {
        $doctor = User::findOrFail($request->doctor_id);

        $previousSchedule = json_decode($doctor->schedule);

        $currentSchedule = collect($previousSchedule)->map(function ($schedule) use($request) {
            if($schedule->day === $request->day && $schedule->hour === $request->hour) {
                $schedule->capacity -= 1;
            }
            return $schedule;
        });

        $doctor->schedule = json_decode($currentSchedule);
        $doctor->save();

        Appointment::create( $request->only(['doctor_id', 'patient_id']) );

        return response()->json([
                'message' => 'رزرو نوبت با موفقیت انجام شد',
                'doctor' => $doctor
            ], 201);
    }
}
