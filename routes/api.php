<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ProjectController;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

//user route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//department route
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('departments', DepartmentController::class);
});

//employee route
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('employees', EmployeeController::class);
});

//project route
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('projects', ProjectController::class);
});