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
Route::apiResource('movies', MovieController::class);
Route::apiResource('age-category', AgeCategoryController::class);

Route::get('sessions/timetable', [SessionController::class, 'timetable']);
Route::apiResource('sessions', SessionController::class);


Route::get('countries', [CountryController::class, 'index']);
Route::get('genres', [GenreController::class, 'index'])->name('index.genres');
Route::post('orders/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');




//Route::get('sessions', [\App\Http\Controllers\Api\SessionController::class, 'index'])->name('index.sessions');
//Route::get('sessions/{session}', [\App\Http\Controllers\Api\SessionController::class, 'show'])->name('show.session');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
