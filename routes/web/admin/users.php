<?php

use App\Http\Controllers\Application\Web\Admin\CategoryController;
use App\Http\Controllers\Application\Web\Admin\UserController;
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

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/', [UserController::class,'index'])->name('index');
    Route::get('user/create',[UserController::class,'create'])->name('create');
    Route::post('users/store', [UserController::class,'store'])->name('store');
    Route::get('user/{id}/show',[UserController::class,'edit'])->name('show');
    Route::post('users/{id}/update', [UserController::class,'update'])->name('update');
    Route::get('users/{id}/delete', [UserController::class,'destroy'])->name('delete');
});

Route::name('categories.')->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class,'index'])->name('index');
    // Route::get('user/create',[UserController::class,'create'])->name('create');
    // Route::post('users/store', [UserController::class,'store'])->name('store');
    // Route::get('user/{id}/show',[UserController::class,'edit'])->name('show');
    // Route::post('users/{id}/update', [UserController::class,'update'])->name('update');
    // Route::get('users/{id}/delete', [UserController::class,'destroy'])->name('delete');
});