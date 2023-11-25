<?php

use App\Http\Controllers\CategoryControllerWeb;
use App\Http\Controllers\DrinkControllerWeb;
use App\Http\Controllers\EventControllerWeb;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankControllerWeb;
use App\Http\Controllers\RoleControllerWeb;
use App\Http\Controllers\UserControllerWeb;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserControllerWeb::class, 'index'])->name('user.index');
    Route::get('/userEdit/{id}', [UserControllerWeb::class, 'edit'])->name('user.edit');
    Route::get('/userCreate', [UserControllerWeb::class, 'create'])->name('user.create');

    Route::get('/events', [EventControllerWeb::class, 'index'])->name('event.index');
    Route::get('/eventEdit/{id}', [EventControllerWeb::class, 'edit'])->name('event.edit');
    Route::get('/eventCreate', [EventControllerWeb::class, 'create'])->name('event.create');

    Route::get('/drinks', [DrinkControllerWeb::class, 'index'])->name('drink.index');
    Route::get('/drinkEdit/{id}', [DrinkControllerWeb::class, 'edit'])->name('drink.edit');
    Route::get('/drinkCreate', [DrinkControllerWeb::class, 'create'])->name('drink.create');

    Route::get('/roles', [RoleControllerWeb::class, 'index'])->name('role.index');
    Route::get('/roleEdit/{id}', [RoleControllerWeb::class, 'edit'])->name('role.edit');
    Route::get('/roleCreate', [RoleControllerWeb::class, 'create'])->name('role.create');

    Route::get('/ranks', [RankControllerWeb::class, 'index'])->name('rank.index');
    Route::get('/rankEdit/{id}', [RankControllerWeb::class, 'edit'])->name('rank.edit');
    Route::get('/rankCreate', [RankControllerWeb::class, 'create'])->name('rank.create');

    Route::get('/categories', [CategoryControllerWeb::class, 'index'])->name('category.index');
    Route::get('/categoryEdit/{id}', [CategoryControllerWeb::class, 'edit'])->name('category.edit');
    Route::get('/categoryCreate', [CategoryControllerWeb::class, 'create'])->name('category.create');
});

require __DIR__.'/auth.php';
