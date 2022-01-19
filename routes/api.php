<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('v1/bookings', App\Http\Controllers\api\v1\BookingController::class)->middleware('api');


// Custom  
//Route::apiResource('v1/bookings/date/{date}', App\Http\Controllers\api\v1\BookingController::class, 'getBookingsByDate')->middleware('api');

Route::get(
        'v1/bookings/date/{date}',
        [App\Http\Controllers\api\v1\BookingController::class, 'getBookingsByDate']
);

// Todo: Just Admin
Route::get(
        'v1/bookings/openinghours/{admin}',
        [App\Http\Controllers\api\v1\BookingController::class, 'getOpeningHours']
);