<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){

    Route::post('login', [AuthController::class, 'login']);
    Route::post('singup', [AuthController::class, 'singup']);

    Route::middleware('auth:api')->group(function () {

        Route::resource('products', ProductController::class)->except(['destroy','delete']);
        Route::resource('categories', CategoryController::class)->except(['destroy','delete']);
        Route::resource('users', UserController::class)->only(['index']);
    });
});

// Route::resource('products', ProductController::class)->except(['destroy','delete']);

// Route::resource('categories', CategoryController::class)->except(['destroy','delete']);

// Route::resource('user', UserController::class)->only(['index']);

