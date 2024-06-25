<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::view("/regions-all", "admin.regions");
