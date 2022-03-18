<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\AdminDepartmentResource;

class AdminDoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'department_id' => $this->department_id,
            'expertise' => $this->expertise,
            'schedule' => $this->schedule,
            'updated_at' => $this->updated_at,
            'department' => new AdminDepartmentResource($this->department)
        ];
    }
}
