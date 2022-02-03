<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminDepartmentResource;
use App\Http\Requests\Admin\Department\CreateDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;

class AdminDepartmentController extends Controller
{
    public function index()
    {
        return AdminDepartmentResource::collection(Department::all());
    }

    public function store(CreateDepartmentRequest $request)
    {
        $depatment = Department::create( $request->only(['name', 'about']) );

        return response()->json([
            'newDepartment' => $depatment,
            'message' => 'دپارتمان جدید با موفقیت ایجاد شد'
        ], 200);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update( $request->only(['name', 'about']) );
 
        return response()->json([
            'department' => $department,
            'message' => 'دپارتمان با موفقیت ویرایش شد'
        ], 200);
    }

    public function destroy(Department $department)
    {
        // Delete row from table
        $department->delete();

        return response()->json([
            'message' => 'دپارتمان مورد نظر با موفقیت حذف شد'
        ], 200);
    }
}
