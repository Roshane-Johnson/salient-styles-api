<?php

use App\Models\Gradient;
use Illuminate\Support\Facades\DB;
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



Route::get('/', function () {
    $APP_NAME = env('APP_NAME') ?? "Salient";
    $APP_VERSION = env('APP_VERSION') ?? "1.0.0";

    return response(["APP_NAME" => $APP_NAME, "APP_VERSION" => $APP_VERSION]);
});
