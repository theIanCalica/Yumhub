<?php

use Illuminate\Support\Facades\Route;

// Routes for admins
Route::view("/regions-all", "admin.regions");
Route::view("/test", "admin.test");
Route::view("/managers", "admin.managers")->name("managers");
Route::view("/riders", "admin.riders")->name("riders");
Route::view("/users", "admin.users")->name("users");
Route::view("/stockholders", "admin.stockholders")->name("stockholders");

Route::prefix('admin')->middleware(['isAuthenticated', 'admin'])->group(function () {
});


//Routes for custoemrs
Route::view("/sign-up", "customer.auth.sign-up")->name("sign-up");
Route::view("/sign-in", "customer.auth.sign-in")->name("sign-in");
Route::view("/", "customer.index")->name("home");

Route::prefix("user")->middleware(["isAuthenticated"])->group(function () {
});
