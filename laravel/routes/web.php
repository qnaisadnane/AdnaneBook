<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WelcomeController;

// ─── Public ───────────────────────────────────────────────────────
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/catalog', [BookController::class, 'index'])->name('catalog');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Stocke l'URL intended avant de rediriger vers login
Route::get('/go-login', function (\Illuminate\Http\Request $request) {
    session()->put('url.intended', $request->get('intended', route('home')));
    return redirect()->route('login');
})->name('go.login');

// ─── Admin only ────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// ─── Admin + Manager ───────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class)->except(['show']);
});

// ─── Admin + Agent ─────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,agent'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ─── Authenticated users ───────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panier
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{bookId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{bookId}', [CartController::class, 'remove'])->name('cart.remove');

    // Commandes client
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
});

require __DIR__.'/auth.php';
