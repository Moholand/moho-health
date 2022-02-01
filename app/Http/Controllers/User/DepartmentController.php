<?php

namespace App\Http\Controllers\User;

use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }
}
