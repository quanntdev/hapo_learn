<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserLessonController;
use App\Http\Controllers\UserProgramController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramController;

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
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index']);

Route::resource('course', CourseController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::get('/redirects', function () {
    return redirect(Redirect::intended()->getTargetUrl());
});

Route::get('reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');

Route::resource('/confirmed', SendMailController::class)->only(['store', 'reset']);

Route::resource('/admin', AdminController::class)->only(['index']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'canJoin'], function () {
        Route::resource('/course-users', UserCourseController::class)->only(['store']);
    });
    Route::group(['middleware' => 'canComment'], function () {
        Route::resource('/comments', CommentController::class)->only(['store']);
    });
    Route::group(['middleware' => 'canLearnLesson'], function () {
        Route::resource('user-lesson', UserLessonController::class)->only(['store']);
    });
    Route::group(['middleware' => 'canLearnProgram'], function () {
        Route::resource('user-program', UserProgramController::class)->only(['store']);
    });
    Route::group(['middleware' => 'seeLesson'], function () {
        Route::resource('lessons', LessonController::class)->only(['show']);
    });
    Route::group(['middleware' => 'admin'], function() {
        Route::resource('/tags', TagController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/lessons', LessonController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/programs', ProgramController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    });
    Route::group(['middleware' => 'teacher'], function() {
        Route::resource('course', CourseController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/tags', TagController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/lessons', LessonController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/programs', ProgramController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    });
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::resource('/course-users', UserCourseController::class)->only(['update']);
    Route::resource('/comments', CommentController::class)->only(['update', 'destroy']);
    Route::resource('/change-password', ChangePasswordController::class)->only(['index', 'store']);
    Route::resource('/users', UserController::class)->only(['index', 'update', 'show']);
});
