<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::middleware(['auth','role:admin,manager'])->group(function(){
    Route::resource('categories',CategoryController::class);
    Route::resource('authors',AuthorController::class);
    Route::resource('books',BookController::class)->except(['show','index']);
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('books',BookController::class)->only(['show','index']);

require __DIR__.'/auth.php';
