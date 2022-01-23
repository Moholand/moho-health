<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminDepartmentResource;

class AdminDepartmentController extends Controller
{
    public function index()
    {
        // $departments = Department::all();

        // return response()->json(['data' => $departments]);
        return AdminDepartmentResource::collection(Department::all());
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
