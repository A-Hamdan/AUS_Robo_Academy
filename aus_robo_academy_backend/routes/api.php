<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ModelController;
use App\Http\Controllers\Api\ModelStepController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\VideoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/programs/', [CategoryController::class, 'getUserCategories']);
    Route::get('user/models/{category}', [ModelController::class, 'getUserModels']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/student/verification', [AuthController::class, 'studentVerification']);
Route::get('/models/{category}', [ModelController::class, 'index']);
Route::get('/get/models', [ModelController::class, 'getMultipleModels']);
Route::get('/model/steps/{model}', [ModelStepController::class, 'index']);
Route::get('/programs', [CategoryController::class, 'getProgramCategory']);
Route::get('/video/categories', [CategoryController::class, 'getVideoCategory']);
Route::get('/videos/{category}', [VideoController::class, 'index']);


// For Frontend
Route::get('/web/programs', [CategoryController::class,'index']);
Route::get('/web/models/{category}', [ModelController::class, 'getModelsByCategory']);

