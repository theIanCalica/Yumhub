<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StockholderController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Models\Restaurant;
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
Route::apiResource("carts", CartController::class);
Route::apiResource("cartItems", CartItemController::class);
Route::post("getCartFood", [CartController::class, "getCartItems"]);

Route::post("/checkout", [StripeController::class, "checkout"]);
Route::post("/checkout-cod", [OrderController::class, "checkout_cod"]);
Route::get("/myOrders/{id}", [OrderController::class, "my_order"]);
// API filters for food
Route::get("/filters", [FoodController::class, "filters"]);

// Api for registeration for customer and seller
Route::post("/register", [UserController::class, "register"]);
Route::post("/seller-register", [UserController::class, "registerSeller"]);

// API for checking email uniqueness
Route::post("/checkEmail", [UserController::class, "checkEmail"]);
Route::post("/restoCheckEmail", [RestaurantController::class, "checkEmail"]);

//Api for update of profile checking of email uniqueness
Route::post("/checkEmail-update", [UserController::class, "checkEmailUpdate"]);
Route::post("/restoCheckEmailUpdate", [RestaurantController::class, "checkEmailUpdate"]);

//Api for update of profile checking of phoneNumber uniqueness
Route::post("/checkPhoneNumber-update", [UserController::class, "checkPhoneNumberUpdate"]);
Route::post("/restoCheckPhoneNumber-update", [UserController::class, "checkPhoneNumberUpdate"]);

//API for checking phoneNumber uniqueness
Route::post("/checkPhoneNumber", [UserController::class, "checkPhoneNumber"]);
Route::post("/checkRestoPhoneNum", [RestaurantController::class, "checkPhoneNum"]);

// API ROUTE FOR HANDLING IMPORTS FOR LARAVEL EXCEL
Route::post("/import-stockholder", [StockholderController::class, "import"])->name("import-stockholder");
Route::post("/import-rider", [RiderController::class, "import"])->name("import-rider");
Route::post("/import-manager", [ManagerController::class, "import"])->name("import");

// Api for logging in first time
Route::put("/put-vendor-details/{id}", [UserController::class, "putVendorDetails"]);
Route::put("/put-user-details/{id}", [UserController::class, "putUserDetails"]);

// API for jquery infinite scrolling
Route::get("/get-articles", [ArticleController::class, "getArticles"]);

// API for updating profile
Route::put("/update-admin/{id}", [UserController::class, "adminChangeProfile"]);
Route::put("/update-customer/{id}", [UserController::class, "updateCustomer"]);
Route::put("/update-seller/{id}", [UserController::class, "updateSeller"]);

// Api for MP1,MP2,MP3
Route::apiResource("managers", ManagerController::class);
Route::apiResource("riders", RiderController::class);
Route::apiResource("stockholders", StockholderController::class);

// API for getting products based on search in cuisine based
Route::post("foods-cuisine", [FoodController::class, "searchBasedOnCuisine"]);
Route::post("/food-search", [FoodController::class, "searchFood"]);
// API ROUTE FOR CHARTS
Route::get("/getTopFoods", [FoodController::class, "getTopFood"]);
Route::get("/getOrders", [OrderController::class, "getMonthlyProfit"]);
Route::get("/getCuisine", [OrderController::class, "getByCuisine"]);
Route::get("/getRecentUsers", [UserController::class, "getRecentUsers"]);

// api for charts in seller
Route::get("/getTopFoodPerResto/{id}", [FoodController::class, "getTopFoodPerResto"]);
Route::get("/category-resto/{id}", [OrderController::class, "getCategoryPerResto"]);
Route::get("/getOrdersResto/{id}", [OrderController::class, "getSalesDataResto"]);
