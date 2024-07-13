<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StockholderController;
use App\Http\Controllers\UserController;
use App\Models\Stockholder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource("users", UserController::class);
Route::apiResource("cuisines", CuisineController::class);
Route::apiResource("categories", CategoryController::class);

// Api for MP1,MP2,MP3
Route::apiResource("managers", ManagerController::class);
Route::apiResource("riders", RiderController::class);
Route::apiResource("stockholders", StockholderController::class);
