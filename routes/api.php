<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
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

//All routes for UserController
Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//All routes for EventController
Route::get('/events', [EventController::class, 'index']);
Route::get('/event/{id}', [EventController::class, 'show']);
Route::post('/event', [EventController::class, 'store']);

//All routes for DrinkController
Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drink/{id}', [DrinkController::class, 'show']);
Route::post('/drink', [DrinkController::class, 'store']);
Route::delete('/drink/{id}', [DrinkController::class, 'destroy']);
