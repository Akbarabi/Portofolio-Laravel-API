<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Web\LanguageController;
use App\Http\Controllers\Web\BladePostController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard.index');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [BladePostController::class, 'index'])->name('posts.index');
    Route::post('/', [BladePostController::class, 'store'])->name('posts.store');
    Route::put('/', [BladePostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}', [BladePostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/language-switch', [LanguageController::class, 'switch'])->name('language.switch');
