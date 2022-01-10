<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\TagController;
use Illuminate\{Support\Facades\Auth, Support\Facades\Route};

Route::post("create_tag", [TagController::class, "apiTagCreate"])->middleware("auth")->name("api.create.tag");
