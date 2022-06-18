<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/',[AttendanceController::class,'index'])->name('index');
    Route::post('/attendance/start',[AttendanceController::class,'start'])->name('start_work');
    Route::post('/attendance/end',[AttendanceController::class,'stop'])->name('end_work');
    Route::post('/rest/start',[RestController::class,'start'])->name('start_rest');
    Route::post('/rest/end',[RestController::class,'stop'])->name('end_rest');
    Route::get('/attendance',[AttendanceController::class,'show'])->name('show');
});



require __DIR__.'/auth.php';