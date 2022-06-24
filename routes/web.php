<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\MyWelcomeController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeamUserController;
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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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

        Route::get('/users/{employee:slug}/teams', 'index')->name('users.teams.index');

        Route::post('/users/{employee:slug}/store', 'store')->name('users.teams.store');

        Route::post('/users/{employee:slug}/teams', 'destroy')->name('users.teams.destroy');
    });
});

require __DIR__ . '/auth.php';
