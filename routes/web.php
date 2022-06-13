<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
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

Route::middleware(['auth'])->group(function () {

    Route::controller(UserController::class)->group(function () {

        Route::get('/users', 'index')->name('dashboard');

        Route::get('/users/create', 'create')->name('users.create');

        Route::post('users/store', 'store')->name('users.store');

        Route::get('/users/{user}/edit', 'edit')->name('users.edit');

        Route::post('/users/{user}/update', 'update')->name('users.update');

        Route::get('/users/{user}/delete', 'delete')->name('users.delete');
    });
});

require __DIR__ . '/auth.php';
