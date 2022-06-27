<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
// Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// redirect view sesuai role
Route::get('/home', function() {
  return redirect('/admin'); 
});


// frontend
Route::get('/', 'HomepageController@home')->name('home');
Route::get('/produk', 'HomepageController@produk');
Route::get('/produk/{id}', 'HomepageController@produkdetail')->name('produkdetail');
// Route::get('/cart/tambah/{id}', 'CartdetailController@tambah');
// Route::get('/cart/kurangi/{id}', 'CartdetailController@kurangi');

Route::group(['middleware'=>['auth','pembeli']],function(){
  Route::resource('cartdetail', 'CartDetailController');
  Route::resource('alamatpengiriman', 'AlamatPengirimanController');
  Route::get('checkout', 'CartController@checkout')->name('checkout');
  Route::get('cart', 'CartController@index')->name('cart');
  Route::patch('kosongkan/{id}', 'CartController@kosongkan');
  // Route::post('/cart/update','CartController@update')->name('cart.update');
});
// end frond end



// route penjual
Route::get('home-penjual', 'Penjual\PenjualController@index')->name('penjual');
Route::get('produk', 'Penjual\ProdukController@index')->name('produk');
Route::get('kategori', 'Penjual\KategoriController@index')->name('kategori');
Route::get('profile', 'Penjual\PenjualController@profile')->name('profile');

Route::group(['prefix'=>'/penjual','middleware'=>['auth','penjual']],function(){
  Route::get('/', 'Penjual\PenjualController@index')->name('penjual');
  Route::resource('kategori', 'Penjual\KategoriController');
  Route::resource('produk', 'Penjual\ProdukController');
  Route::resource('profile', 'Penjual\PenjualController');
  Route::get('image', 'ImageController@index');
  Route::post('image', 'ImageController@store');
  Route::delete('image/{id}', 'ImageController@destroy');
  Route::post('produkimage', 'Penjual\ProdukController@uploadimage');
  Route::delete('produkimage/{id}', 'Penjual\ProdukController@deleteimage');
  Route::get('loadprodukasync/{id}', 'Penjual\ProdukController@loadasync');
});
// end penjual

// route pembeli
Route::get('pembeli', 'Pembeli\PembeliController@index')->name('pembeli');
Route::get('transaksi', 'TransaksiController@index')->name('transaksi');
Route::post('store', 'TransaksiController@store')->name('transaksi.store');
Route::get('show/{id}', 'TransaksiController@show')->name('transaksi.show');
Route::get('edit/{id}', 'TransaksiController@edit')->name('transaksi.edit');
Route::patch('update/{id}', 'TransaksiController@update')->name('transaksi.update');
Route::delete('destroy/{id}', 'TransaksiController@destroy')->name('transaksi.destroy');
Route::get('/confirm/{id}', 'TransaksiController@indexconfirm')->name('confirm.index');
Route::post('upload/','TransaksiController@storeconfirm')->name('confirm.store');


Route::group(['prefix'=>'/pembeli','middleware'=>['auth','pembeli']],function(){
  Route::get('/', 'Pembeli\PembeliController@index')->name('pembeli');
  Route::resource('transaksis', 'TransaksiController'); 
});
// end pembeli



// route admin
Route::get('admin', 'Admin\AdminController@index')->name('admin');
Route::get('users', 'Admin\UserController@index')->name('users');
Route::get('slideshow', 'SlideshowController@index')->name('slideshow');

Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
Route::get('/', 'Admin\AdminController@index')->name('admin');
Route::resource('users', 'Admin\UserController');
Route::resource('slideshow', 'SlideshowController');
});
// end admin