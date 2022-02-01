<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminDepartmentResource;
use App\Http\Requests\Admin\Department\CreateDepartmentRequest;

class AdminDepartmentController extends Controller
{
    public function index()
    {
        return AdminDepartmentResource::collection(Department::all());
    }

    public function store(CreateDepartmentRequest $request)
    {
        $depatment = Department::create( $request->only('name') );

        return response()->json([
            'newDepartment' => $depatment,
            'message' => 'دپارتمان جدید با موفقیت ایجاد شد'
        ], 200);
    }

    public function update(Request $request, Department $department)
    {
        $department->update( $request->only('name') );
 
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
