<?php
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group( function () {
    //Route untuk register user
    Route::post('auth/register', \App\Http\Controllers\Api\Auth\RegisterController::class);
    //Route untuk Login user
    Route::post('auth/login', \App\Http\Controllers\Api\Auth\LoginController::class);
    // Route yang hanya bisa diakses dengan token
    Route::middleware('auth:sanctum')->group(function () {
        //Route untuk Logout user
        Route::post('auth/logout', \App\Http\Controllers\Api\Auth\LogoutController::class);
        Route::resource('category', \App\Http\Controllers\Api\categoryController::class)->except(['edit','create']);
    });

});
