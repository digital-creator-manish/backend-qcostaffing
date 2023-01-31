<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NursesController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\SiteContentController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\QuizTutorialController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FormTypeController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ClientFacilityController;
use App\Http\Controllers\ClienttutorialController;
use App\Http\Controllers\FacilityDepartmentController;
use App\Http\Controllers\FacilityLocationController;
use App\Http\Controllers\FacilityTypeController;
use App\Http\Controllers\FacilityJobClassController;

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

// Route::get('nurse/{id}', [NurseController::class, 'get']);
// Route::get('nursedata', [NurseController::class, 'getAll']);
// Route::post('nurse', [NurseController::class, 'create']);

//Route::post('register', [UserAuthController::class, 'register']);

//Route::apiResource('/employee', 'EmployeeController')->middleware('auth:api');
// Route::apiResource('/employee', EmployeeController::class)->middleware('auth:api');

// Route::apiResource('/nurses', NursesController::class)->middleware('auth:api');

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    Route::post('register', [UserAuthController::class, 'register'])->name('register.api');
    Route::post('login', [UserAuthController::class, 'login'])->name('login.api');
    
});

Route::middleware('auth:api')->group(function () {
    // protected routes
    Route::post('logout', [UserAuthController::class, 'logout'])->name('logout.api');
    // Route::post('discipline', [DisciplineController::class, 'create']); 
    // Route::get('discipline', [DisciplineController::class, 'index']);
    // Route::get('discipline/{id}', [DisciplineController::class, 'show']);
    // Route::put('discipline/{id}', [DisciplineController::class, 'update']);
    // Route::delete('discipline/{id}', [DisciplineController::class, 'delete']);
    Route::apiResource('discipline', DisciplineController::class);
    Route::apiResource('sitecontent', SiteContentController::class);
    Route::apiResource('staff', StaffController::class);
    Route::apiResource('menus', MenusController::class);
    Route::apiResource('skill', SkillController::class);
    Route::apiResource('news', NewsController::class);
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::apiResource('form', FormController::class);
    Route::apiResource('tutorial', TutorialController::class);
    Route::apiResource('quiz_tutorial', QuizTutorialController::class);
    Route::apiResource('document', DocumentController::class);
    Route::apiResource('form_type', FormTypeController::class);
    Route::apiResource('document_type', FormTypeController::class);
    Route::apiResource('facility', ClientFacilityController::class);
    Route::apiResource('client_tutorial', ClienttutorialController::class);
    Route::apiResource('facility_departments', FacilityDepartmentController::class);
    Route::apiResource('facility_locations', FacilityLocationController::class);
    Route::apiResource('facility_types', FacilityTypeController::class);
    Route::apiResource('facility_job_classes', FacilityJobClassController::class);
});
Route::apiResource('download', DownloadController::class);
//Route::post('upload', [StaffController::class, 'upload']);

// Route::get('skill', function(){
//     exit("this-skill");
// });
