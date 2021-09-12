<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\HistoryController;
use App\Http\Controllers\Admin\TransaksiController;

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


Route::group([
  'middleware'=> ['auth'=>'CheckRole:customer']
], function(){
  // Keranjang
  Route::resource('cart', CartController::class);
  Route::post('/keranjang/{id}', [CartController::class, 'keranjang'])->name('keranjang');

  // Checkout
  Route::resource('checkout', CheckoutController::class);
  Route::get('kurir/{id}', [CheckoutController::class, 'kurir']);
  Route::post('jasa', [CheckoutController::class, 'jasa'])->name('jasa');

  // Pesan
  Route::resource('history', HistoryController::class);
});

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




Route::group([
  'prefix' => 'admin',
  'middleware'=> ['auth'=>'CheckRole:admin']
], function(){
  Route::resource('produk', ProdukController::class);
  Route::resource('transaksi', TransaksiController::class);
});