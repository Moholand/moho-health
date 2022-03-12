<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DoctorService 
{
  public function updateSchedule($doctor_id, $day, $hour) : Model
  {
    $doctor = User::findOrFail($doctor_id);

    $previousSchedule = json_decode($doctor->schedule);

    $currentSchedule = collect($previousSchedule)->map(function ($schedule) use($day, $hour) {
        if($schedule->day === $day && $schedule->hour === $hour) {
            $schedule->capacity -= 1;
        }
        return $schedule;
    });

    $doctor->schedule = json_decode($currentSchedule);
    $doctor->save();
    return $doctor;
  }
}