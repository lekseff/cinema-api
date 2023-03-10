<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\HallController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\AgeCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('cinema', [CinemaController::class, 'index'])->name('cinema');

Route::apiResource('halls', HallController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('movies', MovieController::class);
Route::apiResource('slider', SliderController::class);
Route::apiResource('countries', CountryController::class);
Route::apiResource('age-category', AgeCategoryController::class);

Route::get('sessions/timetable', [SessionController::class, 'timetable']);
Route::apiResource('sessions', SessionController::class);

Route::post('orders/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
