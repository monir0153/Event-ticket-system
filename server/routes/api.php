<?php

use App\Http\Controllers\Authenticate\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->withoutMiddleware('auth:api');
    Route::post('login', 'login')->withoutMiddleware('auth:api');
    Route::post('logout', 'logout');
    Route::get('profile', 'profile');
    Route::get('refresh', 'refresh');
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function() {
    Route::get('/roleWisePermission', [RoleController::class, 'index'])->name('roleWisePermission.index');
});