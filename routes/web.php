<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaunchTimeController;

Route::get('/getLaunchData', [LaunchTimeController::class,'getData']);
Route::post('/launchtime', [LaunchTimeController::class,'estTimeCalc']);

Route::get('/', function () {
    return view('welcome');
});
