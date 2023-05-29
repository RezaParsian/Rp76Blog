<?php

use App\Http\Controllers\{Dashboard\ArticleController, Dashboard\CategoryController, Dashboard\CrmController, Dashboard\TagController, Dashboard\Timesheet\TimeSheetController, Dashboard\Timesheet\WorkSpaceController, HomeController};
use Illuminate\Support\{Facades\Route};

Route::name('dashboard')->get('', [HomeController::class, 'index']);

Route::resource("article", ArticleController::class);
Route::resource("category", CategoryController::class);
Route::resource("tag", TagController::class);

Route::resource('crm', CrmController::class);
Route::post("crm/switch", [CrmController::class, "switchUser"])->name('crm.switch.user')->middleware('role:admin');

Route::resource("work_space", WorkSpaceController::class);
Route::group(["prefix"=>'time_sheet',"as"=>'time_sheet.'],function (){
	Route::get("export/{work_space}", [TimeSheetController::class, "exportAsCsv"])->name("export");
	Route::post("",[TimeSheetController::class,"store"])->name("store");
	Route::delete("{time_sheet}",[TimeSheetController::class,"destroy"])->name("destroy");
});