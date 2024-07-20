<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StockholderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Routes for admins
Route::view("/users", "admin.users")->name("users");

Route::prefix('admin')->middleware(['isAuthenticated', 'admin'])->group(function () {
  Route::view("/", "admin.index")->name("admin.home");
  Route::view("/regions-all", "admin.regions");
  Route::view("/managers", "admin.managers")->name("managers");
  Route::view("/riders", "admin.riders")->name("riders");

  Route::view("/stockholders", "admin.stockholders")->name("stockholders");
  Route::view("/cuisines", "admin.cuisines")->name("cuisines");

  Route::view("/categories", "admin.categories")->name("categories");
  Route::view("/contacts", "admin.contacts")->name("contacts");
  Route::post("/import-manager", [ManagerController::class, "import"])->name("import");
});
Route::post("/sign-in/auth", [AuthController::class, "login"])->name("login");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");


//Route for verification
Route::get('/user/verify/{token}', [UserController::class, "verifyEmail"])->name('user.verify');

//Routes for customers
Route::view("/sign-up", "customer.auth.sign-up")->name("sign-up");
Route::view("/sign-in", "customer.auth.sign-in")->name("sign-in");
Route::view("/", "customer.index")->name("home");
Route::view("/about-us", "customer.about-us")->name("about-us");
Route::view("/contact-us", "customer.contact")->name("contact");
Route::view("/email", "customer.email")->name("email-confirmation");
Route::prefix("user")->middleware(["isAuthenticated"])->group(function () {
});



//Route for sellers
Route::view("/seller/sign-up", "seller.sign-up")->name("seller.sign-up");


Route::prefix("seller")->middleware(["isAuthenticated"])->group(function () {
  Route::view("/", "seller.index")->name("seller.home");
  Route::view("/foods", "seller.foods")->name("foods");
});
