<?php

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\AuthenticationController;

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
Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
Route::post('/signin', [AuthenticationController::class, 'signin']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
    Route::apiResources([
        'drivers' => DriverController::class,
        'races' => RaceController::class,
        'circuits' => CircuitController::class,
        'constructors' => ConstructorController::class,
        'results' => ResultController::class,
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


route::get('drivers/search/{surname}', [DriverController::class,'search']);

route::get('circuits/search/{country}', [CircuitController::class,'search']);
