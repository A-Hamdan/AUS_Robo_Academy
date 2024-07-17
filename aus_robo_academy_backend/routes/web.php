<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\ModelStepController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\UserCategoriesController;
use App\Http\Controllers\Admin\UserModelsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'avatar'])->name('avatar.update');
    Route::post('/profile/logo', [ProfileController::class, 'logo'])->name('logo.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/teachers', [UserController::class, 'index'])->name('teachers.index');
    Route::get('/parents', [UserController::class, 'index'])->name('parents.index');

    Route::get('/user/details/{user}', [UserController::class, 'show'])->name('user.details');

    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/teacher/create', [UserController::class, 'create'])->name('teacher.create');
    Route::get('/parent/create', [UserController::class, 'create'])->name('parent.create');

    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/teacher/store', [UserController::class, 'store'])->name('teacher.store');
    Route::post('/parent/store', [UserController::class, 'store'])->name('parent.store');

    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/teacher/edit/{user}', [UserController::class, 'edit'])->name('teacher.edit');

    Route::post('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/teacher/update/{user}', [UserController::class, 'update'])->name('teacher.update');

    Route::get('/user/status/{user}', [UserController::class, 'status'])->name('user.status');
    Route::get('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/state/{id}', [UserController::class, 'getStateByCountry']);
    Route::get('/city/{id}', [UserController::class, 'getCityByState']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/models/{category}', [ModelController::class, 'index'])->name('models.index');
    Route::get('/model/details/{model}', [ModelController::class, 'show'])->name('model.details');
    Route::get('/model/create', [ModelController::class, 'create'])->name('model.create');
    Route::post('/model/store', [ModelController::class, 'store'])->name('model.store');
    Route::get('/model/edit/{model}', [ModelController::class, 'edit'])->name('model.edit');
    Route::post('/model/update/{model}', [ModelController::class, 'update'])->name('model.update');
    Route::get('/model/status/{model}', [ModelController::class, 'status'])->name('model.status');
    Route::get('/model/delete/{model}', [ModelController::class, 'destroy'])->name('model.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/model/steps/{model}', [ModelStepController::class, 'index'])->name('model.steps.index');
    Route::get('/model/steps/details/{modelStep}', [ModelStepController::class, 'show'])->name('model.step.details');
    Route::get('/model/steps/create/{model}', [ModelStepController::class, 'create'])->name('model.step.create');
    Route::post('/model/steps/store', [ModelStepController::class, 'store'])->name('model.step.store');
    Route::get('/model/steps/edit/{modelStep}', [ModelStepController::class, 'edit'])->name('model.step.edit');
    Route::post('/model/steps/update/{modelStep}', [ModelStepController::class, 'update'])->name('model.step.update');
    Route::patch('/model/steps/update/order', [ModelStepController::class, 'updateOrder'])->name('model.step.update.order');
    Route::get('/model/steps/status/{modelStep}', [ModelStepController::class, 'status'])->name('model.step.status');
    Route::get('/model/steps/delete/{modelStep}', [ModelStepController::class, 'destroy'])->name('model.step.destroy');
});


Route::get('/student/programs', [CategoryController::class, 'getCategoriesByOrganisationId'])->name('student.programs.index');
Route::get('/student/models/{category}', [ModelController::class, 'getModelsByProgramAndOrganisationId'])->name('student.models.index');
Route::get('/student/model/steps', [ModelStepController::class, 'index2'])->name('student.model.steps.index');
// kamran ali
Route::get('/student/video/index', [VideoController::class, 'showVideo_category'])->name('student.video.categories.index');
Route::get('/student/video/{category}', [VideoController::class, 'show_video'])->name('student.videos.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/programs', [CategoryController::class, 'index'])->name('programs.index');
    Route::get('/video/categories', [CategoryController::class, 'index'])->name('video.categories.index');
    Route::get('/category/details/{category}', [CategoryController::class, 'show'])->name('category.details');
    Route::get('/programs/create', [CategoryController::class, 'create'])->name('program.create');
    Route::get('/video/category/create', [CategoryController::class, 'create'])->name('video.category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/status/{category}', [CategoryController::class, 'status'])->name('category.status');
    Route::get('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/videos/{category}', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/video/details/{video}', [VideoController::class, 'show'])->name('video.details');
    Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
    Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');
    Route::get('/video/edit/{video}', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('/video/update/{video}', [VideoController::class, 'update'])->name('video.update');
    Route::get('/video/status/{video}', [VideoController::class, 'status'])->name('video.status');
    Route::get('/video/delete/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teacher/programs/{user}', [UserCategoriesController::class, 'index'])->name('user.categories.index');
    Route::get('/teacher/program/create/{user}', [UserCategoriesController::class, 'create'])->name('user.category.create');
    Route::post('/teacher/program/store', [UserCategoriesController::class, 'store'])->name('user.category.store');
    Route::get('/teacher/program/delete', [UserCategoriesController::class, 'destroy'])->name('user.category.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teacher/models/{category}/{user}', [UserModelsController::class, 'index'])->name('user.models.index');
    Route::get('/teacher/model/create/{category}/{user}', [UserModelsController::class, 'create'])->name('user.model.create');
    Route::post('/teacher/model/store', [UserModelsController::class, 'store'])->name('user.model.store');
    Route::get('/teacher/model/delete', [UserModelsController::class, 'destroy'])->name('user.model.destroy');
});

require __DIR__.'/auth.php';
