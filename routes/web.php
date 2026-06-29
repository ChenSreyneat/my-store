<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Language Switcher
Route::get('lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'km'])) {
        Session::put('locale', $lang);
    }
    return back();
})->name('lang.switch');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
// Bakong Payments
Route::post('/bakong/generate-qr', [App\Http\Controllers\BakongController::class, 'generateQr'])->name('bakong.generate');
Route::post('/bakong/check-md5', [App\Http\Controllers\BakongController::class, 'checkMd5'])->name('bakong.check');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category');
Route::get('/product/{product}', [HomeController::class, 'productDetails'])->name('product.details');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Socialite Authentication
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Bakong Simulation (Dev Only)
Route::post('/bakong/simulate', [App\Http\Controllers\BakongController::class, 'simulateSuccess'])->name('bakong.simulate');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Favorites Index
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');

    // Cart Management
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout & Orders
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::delete('/my-orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Public AJAX Routes (Handle Auth internally)
Route::post('/favorites/{product}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

// Admin Routes
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    
    Route::get('/brands', [AdminController::class, 'brands'])->name('brands');
    Route::post('/brands', [AdminController::class, 'storeBrand'])->name('brands.store');
    Route::put('/brands/{id}', [AdminController::class, 'updateBrand'])->name('brands.update');
    Route::delete('/brands/{id}', [AdminController::class, 'destroyBrand'])->name('brands.destroy');

    Route::get('/product-types', [AdminController::class, 'productTypes'])->name('product_types');
    Route::post('/product-types', [AdminController::class, 'storeProductType'])->name('product_types.store');
    Route::put('/product-types/{id}', [AdminController::class, 'updateProductType'])->name('product_types.update');
    Route::delete('/product-types/{id}', [AdminController::class, 'destroyProductType'])->name('product_types.destroy');
    
    Route::get('/stores', [AdminController::class, 'stores'])->name('stores');
    Route::post('/stores', [AdminController::class, 'storeStore'])->name('stores.store');
    Route::put('/stores/{id}', [AdminController::class, 'updateStore'])->name('stores.update');
    Route::delete('/stores/{id}', [AdminController::class, 'destroyStore'])->name('stores.destroy');
    
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/settlement', [AdminController::class, 'settlement'])->name('settlement');
    Route::get('/settlement/store/{id}/orders', [AdminController::class, 'storeOrders'])->name('settlement.store_orders');
    Route::post('/settlement/store/{id}/payout', [AdminController::class, 'payoutStore'])->name('settlement.payout');
    Route::post('/settlement/store/{id}/check-payout', [AdminController::class, 'checkPayoutMd5'])->name('settlement.check_payout');
    Route::get('/payouts', [AdminController::class, 'payouts'])->name('payouts');
    Route::get('/payouts/{id}', [AdminController::class, 'showPayout'])->name('payouts.show');    
    // Impersonation
    Route::post('/users/{id}/impersonate', [AdminController::class, 'impersonate'])->name('users.impersonate');
    Route::post('/stop-impersonating', [AdminController::class, 'stopImpersonating'])->name('stop_impersonating');
    
    // Admin Payment Accounts
    Route::get('/payment-accounts', [AdminController::class, 'paymentAccounts'])->name('payment_accounts');
    Route::post('/payment-accounts', [AdminController::class, 'storePaymentAccount'])->name('payment_accounts.store');
    Route::delete('/payment-accounts/{id}', [AdminController::class, 'destroyPaymentAccount'])->name('payment_accounts.destroy');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// Owner Routes
Route::middleware(['auth', 'can:isOwner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [OwnerController::class, 'products'])->name('products');
    Route::post('/products', [OwnerController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{id}', [OwnerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [OwnerController::class, 'destroyProduct'])->name('products.destroy');
    Route::get('/orders', [OwnerController::class, 'orders'])->name('orders');
    Route::put('/orders/{id}', [OwnerController::class, 'updateOrder'])->name('orders.update');
    Route::get('/payments', [OwnerController::class, 'payments'])->name('payments');
    Route::get('/reports', [OwnerController::class, 'reports'])->name('reports');
    Route::get('/payouts', [OwnerController::class, 'payouts'])->name('payouts');
    Route::get('/payouts/{id}', [OwnerController::class, 'showPayout'])->name('payouts.show');    
    // Owner Payment Accounts
    Route::get('/payment-accounts', [OwnerController::class, 'paymentAccounts'])->name('payment_accounts');
    Route::post('/payment-accounts', [OwnerController::class, 'storePaymentAccount'])->name('payment_accounts.store');
    Route::delete('/payment-accounts/{id}', [OwnerController::class, 'destroyPaymentAccount'])->name('payment_accounts.destroy');
    Route::get('/users', [OwnerController::class, 'users'])->name('users');
    Route::get('/settings', [OwnerController::class, 'settings'])->name('settings');
    Route::post('/settings', [OwnerController::class, 'updateSettings'])->name('settings.update');
});
