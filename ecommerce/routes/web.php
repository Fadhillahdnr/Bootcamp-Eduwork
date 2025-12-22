<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda');
});

Route::get('/products', function () {
    return view('pages.products');
});

Route::get('/cart', function () {
    return view('pages.cart');
});

Route::get('/checkout', function () {
    return view('pages.checkout');
});


