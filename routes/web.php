<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'welcome');

Route::view('/', 'pages.public.index')->name('home');
Route::view('/cart', 'pages.public.cart')->name('cart');
Route::view('/product/detail', 'pages.public.product-detail')->name('product.detail');
Route::view('/cart/update', 'pages.public.cart-update')->name('cart.update');

Route::prefix('auth')->group(function () {
  Route::view('/login', 'pages.auth.login')->name('login');
  Route::view('/register', 'pages.auth.register')->name('register');
  Route::view('/profile', 'pages.auth.profile')->name('profile');
});

Route::prefix('admin')->group(function () {
  Route::view('/products', 'pages.admin.products')->name('products');
  Route::view('/product/create', 'pages.admin.product-create')->name('product.create');
  Route::view('/product/update', 'pages.admin.product-update')->name('product.update');
});
