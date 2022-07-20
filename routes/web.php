<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SortController;

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

Route::get('/test', [HomeController::class, 'test'])->middleware('auth');

Route::resource('course', CourseController::class)->only([
    'index',
]);

Route::get('/search', [CourseController::class,'search'])->name('search');

Route::get('/sort', [CourseController::class, 'sort'])->name('sort');

Route::get('/find', [CourseController::class, 'find'])->name('find');
