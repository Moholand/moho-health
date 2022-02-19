<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DoctorController;
use App\Http\Controllers\User\SliderController;
use App\Http\Controllers\User\DepartmentController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminDepartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/sliders', SliderController::class);
Route::apiResource('/departments', DepartmentController::class)->only(['index', 'show']);
Route::apiResource('/doctors', DoctorController::class)->only('show');

Route::group(['prefix'=>'/admin','as'=>'admin.'], function() {
    Route::apiResource('/sliders', AdminSliderController::class)->except(['show']);
    Route::apiResource('/departments', AdminDepartmentController::class)->except(['show']);
});
