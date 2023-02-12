<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HallController;

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
Route::get('countries', [\App\Http\Controllers\Api\CountryController::class, 'index']);

Route::get('movies', [\App\Http\Controllers\Api\MovieController::class, 'index'])->name('index.movies');
Route::get('movies/{id}', [\App\Http\Controllers\Api\MovieController::class, 'show'])->name('show.movie');

Route::get('genres', [\App\Http\Controllers\Api\GenreController::class, 'index'])->name('index.genres');

Route::apiResource('halls', HallController::class);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
