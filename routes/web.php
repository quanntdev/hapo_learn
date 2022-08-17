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
    'index', 'show'
]);

Route::get('/redirects', function () {
    return redirect(Redirect::intended()->getTargetUrl());
});

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

    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::resource('/course-users', UserCourseController::class)->only(['update']);
    Route::resource('/comments', CommentController::class)->only(['update']);
    Route::resource('lessons', LessonController::class)->only(['show']);
});
