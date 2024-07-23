<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RestaurantController;
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
Route::apiResource("restaurants", RestaurantController::class);
Route::apiResource("articles", ArticleController::class);
Route::get("/get-articles", [ArticleController::class, "getArticles"]);
Route::get("/get-foods", [FoodController::class, "getFoods"]);
Route::get("get-single-food/{id}", [FoodController::class, "getSingleFood"]);


// API filters for food
Route::get("/filters", [FoodController::class, "filters"]);

// Api for registeration for customer and seller
Route::post("/register", [UserController::class, "register"]);
Route::post("/seller-register", [UserController::class, "registerSeller"]);

// API for checking email uniqueness
Route::post("/checkEmail", [UserController::class, "checkEmail"]);
Route::post("/restoCheckEmail", [RestaurantController::class, "checkEmail"]);

//API for checking phoneNumber uniqueness
Route::post("/checkPhoneNumber", [UserController::class, "checkPhoneNumber"]);
Route::post("/checkRestoPhoneNum", [RestaurantController::class, "checkPhoneNum"]);

// API ROUTE FOR HANDLING IMPORTS FOR LARAVEL EXCEL
Route::post("/import-stockholder", [StockholderController::class, "import"]);
Route::post("/import-rider", [RiderController::class, "import"]);


// Api for logging in first time
Route::put("/put-vendor-details/{id}", [UserController::class, "putVendorDetails"]);
Route::put("/put-user-details/{id}", [UserController::class, "putUserDetails"]);

// API for jquery infinite scrolling
Route::get("/get-articles", [ArticleController::class, "getArticles"]);




// Api for MP1,MP2,MP3
Route::apiResource("managers", ManagerController::class);
Route::apiResource("riders", RiderController::class);
Route::apiResource("stockholders", StockholderController::class);
