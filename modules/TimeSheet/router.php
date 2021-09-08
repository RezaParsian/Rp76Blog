<?php

use Illuminate\Support\{Facades\Route};
use Modules\TimeSheet\Controllers\WorkSpaceController;


Route::group(["prefix"=>'dashboard',"middleware"=>'auth'],function (){
    Route::resource("work_space", WorkSpaceController::class);
});
