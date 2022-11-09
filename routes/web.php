<?php

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.master');
})->name('welcome');

Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as'     => 'scores.',
    'prefix' => 'scores',
], function () {
    Route::get('/', [ScoreController::class, 'index'])->name('index');
    Route::get('/create', [ScoreController::class, 'create'])->name('create');
    Route::post('/store', [ScoreController::class, 'store'])->name('store');
    // Route::get('/edit/{user}', [ScoreController::class, 'edit'])->name('edit');
    // Route::put('/update/{user}', [ScoreController::class, 'update'])->name('update');
    // Route::delete('/destroy/{user}', [ScoreController::class, 'destroy'])->name('destroy');
});
