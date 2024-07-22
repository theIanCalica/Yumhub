<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\StockholderController;
use App\Http\Controllers\UserController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;


// Routes for admins
Route::prefix('admin')->middleware(['isAuthenticated', 'admin', 'isActive'])->group(function () {
  Route::view("/", "admin.index")->name("admin.home");
  Route::view("/regions-all", "admin.regions");
  Route::view("/managers", "admin.managers")->name("managers");
  Route::view("/riders", "admin.riders")->name("riders");
  Route::view("/users", "admin.users")->name("users");
  Route::view("/stockholders", "admin.stockholders")->name("stockholders");
  Route::view("/cuisines", "admin.cuisines")->name("cuisines");
  Route::view("/categories", "admin.categories")->name("categories");
  Route::view("/contacts", "admin.contacts")->name("contacts");
  Route::view("/articles", "admin.articles")->name("articles");
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
Route::get("/articles", [ArticleController::class, "index"])->name("articles.view");
Route::view("/cuisines", "customer.cuisines")->name("customerView.cuisines");
Route::prefix("user")->middleware(["isActive", "isAuthenticated", "isCustomer"])->group(function () {
});



//Route for sellers
Route::view("/seller/sign-up", "seller.sign-up")->name("seller.sign-up");

Route::prefix("seller")->middleware(["isAuthenticated", "isActive", "isSeller"])->group(function () {
  Route::view("/", "seller.index")->name("seller.home");
  Route::view("/foods", "seller.foods")->name("foods");
  Route::get("/showProfile/{id}", [UserController::class, "showSeller"])->name("showSeller");
  Route::get("/showRestaurant/{id}", [RestaurantController::class, "showProfile"])->name("showProfileResto");
  Route::view("/change-password", 'seller.changePass')->name("changePass.seller");
  Route::post("/change-password/process", [UserController::class, "sellerUpdatePassword"])->name("seller.update.password");
  Route::post("/updateAcc", [UserController::class, "updateSellerAcc"])->name("updateSellerAcc");
  Route::resource('foods', FoodController::class)->names([
    'store' => 'foods.store',
    'edit' => 'foods.edit',
    'update' => 'foods.update',
    'delete' => 'foods.destroy'
  ]);
  Route::put("/update-food/{id}", [FoodController::class, "updateFood"])->name("updateFood");
  Route::delete("/delete-food/{id}", [FoodController::class, "deleteFood"])->name("deleteFood");
});
