<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WelcomeController;

// ─── Public ──────────────────────────────────────────────────────
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/catalog', [BookController::class, 'index'])->name('catalog');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Redirige vers login en stockant l'URL intended (pour Sign in to Buy)
Route::get('/go-login', function (\Illuminate\Http\Request $request) {
    session()->put('url.intended', $request->get('intended', route('cart.index')));
    return redirect()->route('login');
})->name('go.login');

// ─── Admin / Manager ─────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class)->except(['show', 'index']);
});

// ─── Authenticated users ──────────────────────────────────────────
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panier
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{bookId}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{bookId}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Commandes
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');
});

require __DIR__.'/auth.php';
