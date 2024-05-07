<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth.verifyAPI')->group(function () {
    Route::prefix("/auth")->group(function () {
        Route::post("/login", [Authentication::class, 'login']);
        Route::middleware("auth.verifyBearerToken")->post("/logout", [Authentication::class, 'logout']);
    });

    Route::prefix('/get')->group(function () {
        Route::get("/customer", [CustomerController::class, 'getData']);
        Route::get("/book", [BookController::class, 'getData']);
        Route::get("/rent", [RentController::class, 'getData']);
    });

    Route::prefix('/store')->group(function () {
        Route::post("/customer", [CustomerController::class, 'store']);
        Route::post("/book", [BookController::class, 'store']);
        Route::post("/rent", [RentController::class, 'store']);
    });

    Route::prefix('/show')->group(function(){
        Route::get('/book/{id}', [BookController::class, 'show']);
        Route::get('/customer/{id}', [CustomerController::class, 'show']);
    });

    Route::prefix('/update')->group(function () {
        Route::put("/customer", [CustomerController::class, 'update']);
        Route::put("/book", [BookController::class, 'update']);
    });

    // Change to post if you want to deploy
    Route::prefix('/destroy')->group(function () {
        Route::delete("/customer", [CustomerController::class, 'destroy']);
        Route::delete("/book", [BookController::class, 'destroy']);
    });
});
