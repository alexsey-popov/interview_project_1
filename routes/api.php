<?php

use App\Http\Controllers\EquipmentTypeController;
use App\Http\Controllers\EquipmentController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->createToken('api')->plainTextToken;
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('equipment-type', [EquipmentTypeController::class, 'index'])->name('equipment-type');

    Route::apiResource('equipment', EquipmentController::class);
});
