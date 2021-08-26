<?php

use Illuminate\Support\Facades\Route;

Route::view("rp76","Rp76::index");
Route::get("bisar",[\Modules\Rp76\Controllers\reza::class,"index"]);
