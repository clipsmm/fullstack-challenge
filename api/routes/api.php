<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'all systems are a go',
    ]);
});

Route::get('users', [WeatherController::class, 'index']);
Route::get('users/{user}', [WeatherController::class, 'show']);
