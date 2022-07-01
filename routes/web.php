<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollUserController;
use App\Http\Controllers\MyWelcomeController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\UserTeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{user}/status/update', [UserStatusController::class, 'update'])->name('users.status.update');

Route::get('users/{user}/welcome', [MyWelcomeController::class, 'showWelcomePage'])->name('users.welcome')->middleware('guest');

Route::post('users/{user}/savepassword', [MyWelcomeController::class, 'savePassword'])->name('users.savepassword')->middleware('guest');



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users/{user}/resetpassword', [ResetPasswordController::class, 'resetPassword'])->name('users.resetpassword');
    Route::post('users/{user}/saveresetpassword', [ResetPasswordController::class, 'saveResetPassword'])->name('users.saveresetpassword');

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('users/store', 'store')->name('users.store');
        Route::get('/users/{user:slug}/edit', 'edit')->name('users.edit');
        Route::post('/users/{user:slug}/update', 'update')->name('users.update');
        Route::get('/users/{user:slug}/delete', 'delete')->name('users.delete');
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::post('/categories/store', 'store')->name('categories.store');
        Route::get('/categories/{category:slug}/edit', 'edit')->name('categories.edit');
        Route::post('/categories/{category}/update', 'update')->name('categories.update');
        Route::get('/categories/{category:slug}/delete', 'delete')->name('categories.delete');
    });
    Route::get('/categories/{category:slug}/status/update', [CategoryStatusController::class, 'update'])->name('categories.status.update');


    Route::controller(TeamUserController::class)->group(function () {

        Route::get('/teams/{trainer:slug}/users', 'index')->name('teams.users.index');
        Route::post('/teams/{trainer}/users', 'store')->name('teams.users.store');
        Route::post('/teams/{trainer}/destroy', 'destroy')->name('teams.users.destroy');
    });

    Route::controller(UserTeamController::class)->group(function () {
        Route::get('/users/{user:slug}/teams', 'index')->name('users.teams.index');
        Route::post('/users/{user}/store', 'store')->name('users.teams.store');
        Route::post('/users/{user}/teams', 'destroy')->name('users.teams.destroy');
    });

    Route::controller(CourseController::class)->group(function () {

        Route::get('/courses', 'index')->name('courses.index');
        Route::get('/courses/{course}/show', 'show')->name('courses.show');
        Route::get('/courses/create', 'create')->name('courses.create');
        Route::post('/courses/store', 'store')->name('courses.store');
        Route::get('/courses/{course:slug}/edit', 'edit')->name('courses.edit');
        Route::post('/courses/{course}/update', 'update')->name('courses.update');
        Route::get('/courses/{course}/destroy', 'destroy')->name('courses.destroy');
    });

    Route::controller(EnrollUserController::class)->group(function () {
        Route::get('/courses/{course}/enroll', 'index')->name('courses.enroll.index');
        Route::post('/courses/{course}/store', 'store')->name('courses.enroll.store');
        Route::post('/courses/{course}/destroy', 'destroy')->name('courses.user.destroy');
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('/units/{course}/create', 'create')->name('units.create');
        Route::post('/units/{course}/store', 'store')->name('units.store');
        Route::get('/units/{unit}edit', 'edit')->name('units.edit');
        Route::post('/units/{unit}/update', 'update')->name('units.update');
        Route::get('/unit/{unit}/destroy', 'destroy')->name('units.destroy');
    });
});

require __DIR__ . '/auth.php';
