<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});
/*
|--------------------------------------------------------------------------
| HALAMAN UMUM (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', [HomeController::class, 'index'])
        ->name('user.dashboard');

    /*
    |--------------------------------------------------------------------------
    | KERANJANG
    |--------------------------------------------------------------------------
    */
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::get('/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::get('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
        Route::get('/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    });

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PESANAN
    |--------------------------------------------------------------------------
    */
    Route::get('/orders', [UserOrderController::class, 'history'])
        ->name('user.orders');

    Route::get('/orders/{id}', [UserOrderController::class, 'detail'])
        ->name('user.orders.detail');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('/products', ProductController::class);

        /*
        |--------------------------------------------------------------------------
        | ORDER MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders');

        Route::get('/orders/{id}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.status');
});
