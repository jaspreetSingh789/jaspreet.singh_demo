<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTeamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EnrollUserController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\MyWelcomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamCourseController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserEnrollmentController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\UserTeamController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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

    if (Auth::check()) {
        if (Auth::user()->is_employee) {
            return redirect()->route('mycourses.index');
        }
    }

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users/{user}/resetpassword', [ResetPasswordController::class, 'resetPassword'])->name('users.resetpassword');
    Route::post('users/{user}/saveresetpassword', [ResetPasswordController::class, 'saveResetPassword'])->name('users.saveresetpassword');

    Route::controller(LearnerController::class)->group(function () {
        Route::get('/mycourses', 'index')->name('mycourses.index');
    });

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
        Route::post('/teams/{trainer}/users/store', 'store')->name('teams.users.store');
        Route::post('/teams/{trainer}/users/destroy', 'destroy')->name('teams.users.destroy');
    });

    Route::controller(UserTeamController::class)->group(function () {
        Route::get('/users/{user:slug}/teams', 'index')->name('users.teams.index');
        Route::post('/users/{user}/teams/store', 'store')->name('users.teams.store');
        Route::post('/users/{user}/teams/destroy', 'destroy')->name('users.teams.destroy');
    });

    Route::controller(TeamCourseController::class)->group(function () {
        Route::get('/teams/{trainer:slug}/courses', 'index')->name('teams.courses.index');
        Route::post('/teams/{trainer}/courses/store', 'store')->name('teams.courses.store');
        Route::post('/teams/{trainer}/courses/destroy', 'destroy')->name('teams.courses.destroy');
    });

    Route::controller(UserEnrollmentController::class)->group(function () {
        Route::get('/users/{user:slug}/courses', 'index')->name('users.courses.index');
        Route::post('/users/{user}/courses/store', 'store')->name('users.courses.store');
        Route::post('/users/{user}/courses/destroy', 'destroy')->name('users.courses.destroy');
    });

    Route::controller(CourseController::class)->group(function () {

        Route::get('/courses', 'index')->name('courses.index');
        Route::get('/courses/{course:slug}/show', 'show')->name('courses.show');
        Route::get('/courses/create', 'create')->name('courses.create');
        Route::post('/courses/store', 'store')->name('courses.store');
        Route::get('/courses/{course:slug}/edit', 'edit')->name('courses.edit');
        Route::post('/courses/{course}/update', 'update')->name('courses.update');
        Route::get('/courses/{course}/destroy', 'destroy')->name('courses.destroy');
    });

    Route::controller(EnrollmentController::class)->group(function () {
        Route::get('/courses/{course:slug}/enroll', 'index')->name('courses.enroll.index');
        Route::post('/courses/{course}/store', 'store')->name('courses.enroll.store');
        Route::post('/courses/{course}/destroy', 'destroy')->name('courses.user.destroy');
    });

    Route::controller(CourseTeamController::class)->group(function () {
        Route::get('/courses/{course:slug}/assign', 'index')->name('courses.assign.index');
        Route::post('/courses/{course}/assign/store', 'store')->name('courses.assign.store');
        Route::post('/courses/{course}/assign/destroy', 'destroy')->name('courses.assign.destroy');
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('/courses/{course:slug}/units/create', 'create')->name('courses.units.create');
        Route::post('/courses/{course}/units/store', 'store')->name('courses.units.store');
        Route::get('/courses/{course:slug}/units/{unit:slug}/edit', 'edit')->name('courses.units.edit');
        Route::post('/courses/{course}/units/{unit}/update', 'update')->name('courses.units.update');
        Route::get('/courses/{course:slug}/units/{unit:slug}/destroy', 'destroy')->name('courses.units.destroy');
    });

    Route::controller(TestController::class)->group(function () {
        Route::get('/courses/{course:slug}/units/{unit}/tests/create', 'create')->name('courses.units.tests.create');
        Route::post('/courses/{course}/units/{unit}/tests/store', 'store')->name('courses.units.tests.store');
        Route::get('/courses/{course:slug}/tests/{test}/edit', 'edit')->name('courses.tests.edit');
        Route::post('/courses/{course}/tests/{test}/update', 'update')->name('courses.tests.update');
    });

    Route::controller(QuestionController::class)->group(function () {
        Route::get('/courses/{course:slug}/tests/{test}/questions/create', 'create')->name('courses.tests.questions.create');
        Route::post('/courses/{course}/tests/{test}/questions/store', 'store')->name('courses.tests.questions.store');
        Route::get('/courses/{course}/tests/{test}/questions/{question}/edit', 'edit')->name('courses.tests.questions.edit');
        Route::post('/courses/{course}/tests/{test}/questions/{question}/update', 'update')->name('courses.tests.questions.update');
        Route::get('/courses/{course}/tests/{test}/questions/{question}/destroy', 'destroy')->name('courses.tests.questions.destroy');
    });
});

require __DIR__ . '/auth.php';
