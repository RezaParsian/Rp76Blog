<?php

use Illuminate\Support\{Facades\Route};
use Modules\TimeSheet\{Controllers\TimeSheetController, Controllers\WorkSpaceController};


Route::group(["prefix"=>'dashboard',"middleware"=>'auth'],function (){
    Route::resource("work_space", WorkSpaceController::class);
    Route::group(["prefix"=>'time_sheet',"as"=>'time_sheet.'],function (){
        Route::get("export/{work_space}", [TimeSheetController::class, "exportAsCsv"])->name("export");
        Route::post("",[TimeSheetController::class,"store"])->name("store");
        Route::delete("{time_sheet}",[TimeSheetController::class,"destroy"])->name("destroy");
    });
});
