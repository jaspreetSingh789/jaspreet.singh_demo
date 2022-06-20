<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyWelcomeController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserStatusController;

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

        Route::get('/users/{user}/edit', 'edit')->name('users.edit');

        Route::post('/users/{user}/update', 'update')->name('users.update');

        Route::get('/users/{user}/delete', 'delete')->name('users.delete');

        Route::controller(CategoryController::class)->group(function () {

            Route::get('/categories', 'index')->name('categories.index');

            Route::get('/categories/create', 'create')->name('categories.create');

            Route::post('/categories/store', 'store')->name('categories.store');
        });
    });
});

require __DIR__ . '/auth.php';
