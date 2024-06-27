<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

// Routes for admins
Route::view("/regions-all", "admin.regions");

//Routes for custoemrs
Route::view("/sign-up", "customer.auth.sign-up")->name("sign-up");
Route::view("/sign-in", "customer.auth.sign-in")->name("sign-in");
