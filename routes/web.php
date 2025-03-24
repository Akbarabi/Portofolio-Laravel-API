<?php

use App\Http\Controllers\Web\BladePostController;
use App\Http\Controllers\Web\LanguageController;
use Illuminate\Support\Facades\Route;

Route::view("/", 'guest.index')->name('guest.index');
Route::view("/about", 'guest.about')->name('guest.about');
Route::view("/project", 'guest.project')->name('guest.project');
Route::view("/noidea", 'utility.noidea')->name('guest.noidea');

Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard.index');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [BladePostController::class, 'index'])->name('posts.index');
    Route::get('/trashed', [BladePostController::class, 'trashed'])->name('posts.trashed');
    Route::post('/', [BladePostController::class, 'store'])->name('posts.store');
    Route::put('/', [BladePostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}', [BladePostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/delete/{id}', [BladePostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::post('/restore/{id}', [BladePostController::class, 'restore'])->name('posts.restore');
});

Route::get('/language-switch', [LanguageController::class, 'switch'])->name('language.switch');

Route::view('/reset-password', 'auth.reset-password');
