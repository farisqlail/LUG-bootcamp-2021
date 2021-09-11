<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProdukController;

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

Route::resource('home', HomeController::class);
Route::get('/', [HomeController::class, 'index']);
Route::view('/cart', 'pages.public.cart')->name('cart');
Route::view('/product/detail', 'pages.public.product-detail')->name('product.detail');
Route::view('/cart/update', 'pages.public.cart-update')->name('cart.update');

Route::group([
  'prefix' => 'auth',
  'namespace'=> 'Auth',
], function(){
  Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
  Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
  Route::post('/register',  [RegisterController::class, 'store'])->name('register');
  Route::view('/profile', 'pages.auth.profile')->name('profile');
});



// Route::prefix('admin')->group(function () {
//   Route::view('/products', 'pages.admin.products')->name('products');
//   Route::view('/product/create', 'pages.admin.product-create')->name('product.create');
//   Route::view('/product/update', 'pages.admin.product-update')->name('product.update');
// });


Route::group([
  'prefix' => 'admin',
  'middleware'=> ['auth'=>'CheckRole:admin']
], function(){
  Route::resource('produk', ProdukController::class);
});