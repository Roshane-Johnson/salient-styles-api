<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\GradientController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Auth
Route::post("login", [AuthenticationController::class, 'login']);
Route::post("signup", [AuthenticationController::class, 'signup']);
Route::post("logout", [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

// Email Verification

// Miscellaneous
Route::get("token/verify", [AuthenticationController::class, 'verifyToken']);
Route::get("gradient/all", [GradientController::class, "index"]);
Route::get("gradient/{gradient}", [GradientController::class, "show"]);

// Protected
Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::get("profile", [UserController::class, 'authUser']);
    Route::post("profile/update/socials", [SocialMediaController::class, 'store']);

    // Gradient CRUD
    Route::group(["prefix" => "gradient", "controller" => GradientController::class], function () {
        Route::post("create", "store");
        Route::put("update/{id}", "update");
    });
});
