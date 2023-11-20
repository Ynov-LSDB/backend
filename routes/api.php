<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;

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

//Auth routes for Sanctum
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');                            // auth
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');                    // auth

//All routes for UserController
Route::get('/users', [UserController::class, 'index']);
Route::get('/user/nextEvent', [UserController::class, 'nextEvent'])->middleware('auth:sanctum');         // auth
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store'])->middleware(['auth:sanctum', 'admin']);                      // auth && admin
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');             // auth && (admin || user_id == id)
Route::put('/user/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');                 // auth && (admin || user_id == id)

//All routes for EventController
Route::get('/events', [EventController::class, 'index']);
Route::get('/event/last', [EventController::class, 'last']);
Route::get('/event/{id}', [EventController::class, 'show']);
Route::post('/event', [EventController::class, 'store']);
Route::delete('/event/{id}', [EventController::class, 'destroy']);
Route::put('/event/{id}', [EventController::class, 'update']);

//All routes for DrinkController
Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drink/{id}', [DrinkController::class, 'show']);
Route::post('/drink', [DrinkController::class, 'store']);
Route::delete('/drink/{id}', [DrinkController::class, 'destroy']);
Route::put('/drink/{id}', [DrinkController::class, 'update']);

//All routes for Role
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/role/{id}', [RoleController::class, 'show']);
Route::post('/role', [RoleController::class, 'store']);
Route::delete('/role/{id}', [RoleController::class, 'destroy']);
Route::put('/role/{id}', [RoleController::class, 'update']);

//All routes for Category
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category', [CategoryController::class, 'store']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
Route::put('/category/{id}', [CategoryController::class, 'update']);

//All routes for rank
Route::get('/ranks', [RankController::class, 'index']);
Route::get('/rank/{id}', [RankController::class, 'show']);
Route::post('/rank', [RankController::class, 'store']);
Route::delete('/rank/{id}', [RankController::class, 'destroy']);
Route::put('/rank/{id}', [RankController::class, 'update']);
