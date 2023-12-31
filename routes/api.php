<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DrinkController;
use App\Http\Controllers\Api\DrinkEventController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\RankController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserEventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');                            // auth
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');                    // auth

//All routes for UserController
Route::get('/users', [UserController::class, 'index']);
Route::get('/user/nextEvent', [UserController::class, 'nextEvent'])->middleware('auth:sanctum');         // auth
Route::get('/user/inEvent', [UserController::class, 'inEvent'])->middleware('auth:sanctum');                    // auth
Route::get('/user/notInEvent', [UserController::class, 'notInEvent'])->middleware('auth:sanctum');                 // auth
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store'])->middleware(['auth:sanctum', 'admin']);                      // auth && admin
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');             // auth && (admin || user_id == id)
Route::post('/user/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');                 // auth && (admin || user_id == id)
Route::get('/user/joinEvent/{id}', [UserController::class, 'joinEvent'])->middleware('auth:sanctum');     // auth
Route::get('/user/leaveEvent/{id}', [UserController::class, 'leaveEvent'])->middleware('auth:sanctum'); // auth
Route::get('/users/ranking', [UserController::class, 'getRankingPaginate']);
Route::post('/users/ranking/weekly-reduction', [UserController::class, 'weeklyScoreReduction']);           // auth

//All routes for EventController
Route::get('/events', [EventController::class, 'index']);
Route::get('/eventsPaginated', [EventController::class, 'indexPaginated']);
Route::get('/event/last', [EventController::class, 'last']);
Route::get('/event/{id}', [EventController::class, 'show']);
Route::post('/event', [EventController::class, 'store'])->middleware(['auth:sanctum']);                            // auth
Route::delete('/event/{id}', [EventController::class, 'delete'])->middleware(['auth:sanctum']);                    // auth && (admin || creator_id == user_id)
Route::post('/event/{id}', [EventController::class, 'update'])->middleware('auth:sanctum');              // auth && (admin || creator_id == user_id)
Route::post('/event/close/{id}', [EventController::class, 'close'])->middleware('auth:sanctum');         // auth && (admin || creator_id == user_id)

//All routes for DrinkController
Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drink/{id}', [DrinkController::class, 'show']);
Route::post('/drink', [DrinkController::class, 'store'])->middleware(['auth:sanctum', 'admin']);                    // auth && admin
Route::delete('/drink/{id}', [DrinkController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);           // auth && admin
Route::put('/drink/{id}', [DrinkController::class, 'update'])->middleware(['auth:sanctum', 'admin']);               // auth && admin

//All routes for Role
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/role/{id}', [RoleController::class, 'show']);
Route::post('/role', [RoleController::class, 'store'])->middleware(['auth:sanctum', 'admin']);                      // auth && admin
Route::delete('/role/{id}', [RoleController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);             // auth && admin
Route::put('/role/{id}', [RoleController::class, 'update'])->middleware(['auth:sanctum', 'admin']);                 // auth && admin

//All routes for Category
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category', [CategoryController::class, 'store'])->middleware(['auth:sanctum', 'admin']);              // auth && admin
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);     // auth && admin
Route::put('/category/{id}', [CategoryController::class, 'update'])->middleware(['auth:sanctum', 'admin']);         // auth && admin

//All routes for rank
Route::get('/ranks', [RankController::class, 'index']);
Route::get('/rank/{id}', [RankController::class, 'show']);
Route::post('/rank', [RankController::class, 'store'])->middleware(['auth:sanctum', 'admin']);                      // auth && admin
Route::delete('/rank/{id}', [RankController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);             // auth && admin
Route::put('/rank/{id}', [RankController::class, 'update'])->middleware(['auth:sanctum', 'admin']);                 // auth && admin

//All routes for UserEvent
Route::get('/userEvents', [UserEventController::class, 'index'])->middleware(['auth:sanctum', 'admin']);           // auth && admin
Route::post('/userEvent', [UserEventController::class, 'store'])->middleware(['auth:sanctum', 'admin']);           // auth && admin
Route::delete('/userEvent/{id}', [UserEventController::class, 'delete'])->middleware(['auth:sanctum', 'admin']);   // auth && admin

//All routes for DrinkEvent
Route::get('/drinkEvents', [DrinkEventController::class, 'index'])->middleware(['auth:sanctum', 'admin']);         // auth && admin
Route::post('/drinkEvent', [DrinkEventController::class, 'store'])->middleware(['auth:sanctum', 'admin']);         // auth && admin
Route::delete('/drinkEvent/{id}', [DrinkEventController::class, 'delete'])->middleware(['auth:sanctum', 'admin']); // auth && admin
