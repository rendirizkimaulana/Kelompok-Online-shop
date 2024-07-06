<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/get-snap-token', [PaymentController::class, 'getSnapToken'])->name('snap.create');
Route::post('/get-snap-store_', [PaymentController::class, 'store_'])->name('snap.store_');
Route::post('/midtrans-notification', [PaymentController::class, 'handleNotification']);
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(App\Http\Controllers\AdminController::class)->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', 'index')->name('index.admin');
        Route::get('/data-penjualan', 'data_penjualan')->name('data_penjualan.admin');
        Route::post('/detail_transaksi', 'detail_transaksi')->name('detail_transaksi.admin');
        Route::post('/update-transaksi', 'store_')->name('update-transaksi.admin');


        Route::get('/produk', 'index_produk')->name('index_produk.admin');
        Route::get('/tambah/produk', 'tambah_produk')->name('tambah_produk.admin');
        Route::post('/produk-transaksi', 'store_produk')->name('produk-tambah-transaksi.admin');


        Route::get('/kontem', 'index_konten')->name('index_konten.admin');
        Route::post('/hapuskonten', 'delete_')->name('delete_.admin');
        Route::get('/tambah_konten', 'tambah_konten')->name('tambah_konten.admin');
        Route::post('/tambah_konten-file', 'store_file')->name('store_file.admin');

    });
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('beranda');
Route::get('/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/{id}/detail', [App\Http\Controllers\HomeController::class, 'detail_p'])->name('detail_p');
Route::get('/{id}/{size}/{id_2}/checkout', [App\Http\Controllers\HomeController::class, 'checkout_p'])->name('checkout');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile_index'])->name('profile');


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', [App\Http\Controllers\HomeController::class, 'index_about'])->name('about');
// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/products', function () {
//     return view('product');
// });

Route::get('/teamproject', function () {
    return view('teamproject');
});

Route::get('/detail', function () {
    return view('detail');
});
