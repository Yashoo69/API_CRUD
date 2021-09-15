<?php

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\ConstructorController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'drivers' => DriverController::class,
    'races' => RaceController::class,
    'circuits' => CircuitController::class,
    'constructors' => ConstructorController::class,
    'results' => ResultController::class,
]);
