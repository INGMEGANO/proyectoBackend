<?php

use App\Http\Controllers\V1\EmployeesController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\v1\ManagerController;
use App\Http\Controllers\v1\AssignmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    //Every method under this prefix has to be written in the browser as following: "api/v1/...."
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);
    //Middleware for token authentication
    Route::group(['middleware' => ['jwt.verify']], function() {
        //Every method in this middleware group requires jwt verification.
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::put('associate',[ManagerController::class,'associateToManager']);
        Route::get('employees',[EmployeesController::class,'show']);
        Route::get('employees/{id}',[EmployeesController::class,'showDetailedInfo']);
        Route::post('employeesCreate',[EmployeesController::class,'store']);
        Route::put('employeesUpdate/{id}',[EmployeesController::class,'update']);
        Route::delete('employeesDelete/{id}',[EmployeesController::class,'destroy']);
        Route::post('submitHours',[AssignmentsController::class,'store']);
        Route::get('getHoursSubmitted/{id}',[AssignmentsController::class,'getHoursSubmitted']);
        Route::get('getEmployees/{id}',[ManagerController::class,'getEmployees']);
        Route::get('getManagers',[ManagerController::class,'getManagers']);
    });
});
