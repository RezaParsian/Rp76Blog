<?php

use Illuminate\Support\Facades\Route;
use Modules\CRM\Controllers\CrmController;

Route::group(["prefix" => "dashboard", "middleware" => "auth"], function () {
    Route::resource('crm', CrmController::class);
    Route::post("crm/switch",[CrmController::class,"switchUser"])->name('crm.switch.user')->middleware('role:admin');
});
