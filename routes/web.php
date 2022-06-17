<?php

use App\Http\Controllers\MyWelcomeController;
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
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/users/{user}/status/update', [UserStatusController::class, 'update'])->name('users.status.update');

Route::get('users/{user}/welcome', [MyWelcomeController::class, 'showWelcomePage'])->name('users.welcome');

Route::post('users/{user}/savepassword', [MyWelcomeController::class, 'savePassword'])->name('users.savepassword');

Route::middleware(['auth'])->group(function () {

    Route::controller(UserController::class)->group(function () {

        Route::get('/users', 'index')->name('dashboard');

        Route::get('/users/create', 'create')->name('users.create');

        Route::post('users/store', 'store')->name('users.store');

        Route::get('/users/{user}/edit', 'edit')->name('users.edit');

        Route::post('/users/{user}/update', 'update')->name('users.update');

        Route::get('/users/{user}/delete', 'delete')->name('users.delete');

        // Route::get(/restore/{id}','restore')->name('users.restore')
    });
});

require __DIR__ . '/auth.php';
