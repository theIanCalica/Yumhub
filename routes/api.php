<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StockholderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource("users", UserController::class);
Route::apiResource("cuisines", CuisineController::class);
Route::apiResource("categories", CategoryController::class);
Route::apiResource("contactMessages", ContactMessageController::class);

// Api for registeration for customer and seller
Route::post("/register", [UserController::class, "register"]);

// API for checking email uniqueness
Route::post("/checkEmail", [UserController::class, "checkEmail"]);

//API for checking phoneNumber uniqueness
Route::post("/checkPhoneNumber", [UserController::class, "checkPhoneNumber"]);
// Api for logging in first time
Route::put("/put-vendor-details/{id}", [UserController::class, "putVendorDetails"]);
Route::put("/put-user-details/{id}", [UserController::class, "putUserDetails"]);

// API for signing in
Route::post("/sign-in/auth", [AuthController::class, "login"]);



// Api for MP1,MP2,MP3
Route::apiResource("managers", ManagerController::class);
Route::apiResource("riders", RiderController::class);
Route::apiResource("stockholders", StockholderController::class);
