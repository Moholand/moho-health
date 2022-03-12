<?php

namespace App\Http\Controllers\User;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Appointment\StoreAppointmentRequest;
use App\Services\DoctorService;

class AppointmentController extends Controller
{
    public function store(StoreAppointmentRequest $request, DoctorService $service)
    {
        $doctor = $service->updateSchedule($request->doctor_id, $request->day, $request->hour);

        Appointment::create( $request->only(['doctor_id', 'patient_id']) );

        return response()->json([
            'message' => 'رزرو نوبت با موفقیت انجام شد',
            'doctor' => $doctor
        ], 201);
    }
}
