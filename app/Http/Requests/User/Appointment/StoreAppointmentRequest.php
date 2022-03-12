<?php

namespace App\Http\Requests\User\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doctor_id' => 'required|integer|exists:users,id',
            'patient_id' => 'required|integer|exists:users,id',
            'day' => 'required|string',
            'hour' => 'required|string'
        ];
    }
}
