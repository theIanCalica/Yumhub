<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StockholderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes for admins
Route::view("/regions-all", "admin.regions");
Route::view("/test", "admin.test");
Route::view("/managers", "admin.managers")->name("managers");
Route::view("/riders", "admin.riders")->name("riders");
Route::view("/users", "admin.users")->name("users");
Route::view("/stockholders", "admin.stockholders")->name("stockholders");
Route::view("/cuisines", "admin.cuisines")->name("cuisines");
Route::view("/admins", "admin.index")->name("admin.home");
Route::view("/categories", "admin.categories")->name("categories");

Route::post("/import-manager", [ManagerController::class, "import"])->name("import");
Route::post("/import-rider", [RiderController::class, "import"])->name("import-rider");
Route::post("/import-stockholder", [StockholderController::class, "import"])->name("import-stockholder");

Route::prefix('admin')->middleware(['isAuthenticated', 'admin'])->group(function () {
});


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



//Route for vendors
Route::view("/seller/sign-up", "seller.sign-up")->name("seller.sign-up");
Route::prefix("vendor")->middleware(["isAuthenticated"])->group(function () {
});
