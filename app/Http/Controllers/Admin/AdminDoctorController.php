<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminDoctorResource;

class AdminDoctorController extends Controller
{
    public function index()
    {
        return AdminDoctorResource::collection(
            User::where('role_id', Role::DOCTOR)->with('department')->get()
        );
    }
}
