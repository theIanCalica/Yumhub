<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("regions", RegionController::class);
Route::apiResource("provinces", ProvinceController::class);
Route::apiResource("cities", CityController::class);
Route::apiResource("users", UserController::class);
Route::apiResource("managers", ManagerController::class);
Route::apiResource("riders", RiderController::class);
