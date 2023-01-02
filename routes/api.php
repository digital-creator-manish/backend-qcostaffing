<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NursesController;
use App\Http\Controllers\Auth\UserAuthController;

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

Route::get('nurse/{id}', [NurseController::class, 'get']);
Route::get('nursedata', [NurseController::class, 'getAll']);
Route::post('nurse', [NurseController::class, 'create']);

//Route::post('register', [UserAuthController::class, 'register']);

//Route::apiResource('/employee', 'EmployeeController')->middleware('auth:api');
// Route::apiResource('/employee', EmployeeController::class)->middleware('auth:api');

// Route::apiResource('/nurses', NursesController::class)->middleware('auth:api');

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // ...
    Route::post('register', [UserAuthController::class, 'register'])->name('register.api');
    Route::post('login', [UserAuthController::class, 'login'])->name('login.api');
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('logout', [UserAuthController::class, 'logout'])->name('logout.api');
});
