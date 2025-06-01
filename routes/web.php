<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductManagementController;
use App\Http\Livewire\Shop;
use App\Http\Livewire\SingleProduct;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Checkout;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserOrdersController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;


Route::get('/', [ProductController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/shop', Shop::class)->name('shop');
    Route::get('/product/{id}', SingleProduct::class)->name('single-product');
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/contact', fn() => view('contact'))->name('contact');
    Route::get('/my-orders', [UserOrdersController::class, 'index'])->name('user.orders');

    // Admin
    Route::middleware([AdminMiddleware::class])->group(function () {
        // Admin dashboard
        Route::get('/admin', [AdminController::class, 'index'])
            ->name('admin');

        // Update order status
        Route::patch(
            '/admin/orders/{id}',
            [AdminController::class, 'updateOrderStatus']
        )
            ->name('admin.orders.update');

        // Product‐management CRUD pages
        Route::get(
            '/product-management',
            [ProductManagementController::class, 'index']
        )
            ->name('product.management');
        Route::post(
            '/product-management',
            [ProductManagementController::class, 'store']
        )
            ->name('product.add');
        Route::post(
            '/product-management/update',
            [ProductManagementController::class, 'update']
        )
            ->name('product.update');
        Route::delete(
            '/product-management/delete',
            [ProductManagementController::class, 'destroy']
        )
            ->name('product.delete');
    });

    // User
    Route::middleware([UserMiddleware::class])->group(function () {
        
    });
});

require __DIR__ . '/auth.php';
