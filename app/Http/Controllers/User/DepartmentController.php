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

    public function show($id)
    {
        return new DepartmentResource(Department::with('doctors')->findOrFail($id));
    }
}
