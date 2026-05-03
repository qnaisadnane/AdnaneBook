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
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;
// ─── Public ───────────────────────────────────────────────────────
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.send');
Route::get('/catalog', [BookController::class, 'index'])->name('catalog');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show')->where('id', '[0-9]+');

// Panier accessible sans auth
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{bookId}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

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
    
    // Admin Messages
    Route::get('/admin/messages', [AdminContactController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/{id}', [AdminContactController::class, 'show'])->name('admin.messages.show');
    Route::delete('/admin/messages/{id}', [AdminContactController::class, 'destroy'])->name('admin.messages.destroy');
});

// ─── Admin ───────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class)->except(['show']);
});

// ─── Admin  ─────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ─── Authenticated users ───────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panier (update/remove nécessitent auth)
    Route::patch('/cart/{bookId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{bookId}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Commandes client
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/orders/{id}/download-invoice', [OrderController::class, 'downloadInvoice'])->name('orders.download-invoice');
});

Route::get('/details/{id}', [BookController::class, 'show'])->name('details');

require __DIR__.'/auth.php';
