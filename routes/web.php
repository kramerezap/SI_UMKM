<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\AdminController;
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
//FE
/*Route::get('/', 'FeController@index');
Route::get('/komen={id}', 'FeController@komen');
Route::post('/postkomen', 'FeController@postkomen');
*/

//login
Route::get('/', 'LoginController@login');
Route::post('/loginaction','LoginController@loginaction');
Route::get('/register', 'LoginController@register');
Route::post('/registeraction','LoginController@registeraction');
Route::get('/registerpm', 'LoginController@registerpm');
Route::post('/registerpmaction','LoginController@registerpmaction');

//PEMILIKKKKKKK
Route::post('/pemilik:persetujuan={id}', 'PemilikController@persetujuan');
Route::get('/tambahstokcabang', 'PemilikController@tambahstokcabang');
Route::get('/jadwalpengirimanpm', 'PemilikController@jadwalpengirimanpm');
Route::get('/komen0pm={id}', 'PemilikController@komen0pm');
Route::get('/komen1pm={id}', 'PemilikController@komen1pm');
Route::get('/hapuskomenpm={id}', 'PemilikController@hapuskomenpm');
Route::get('/komentarpm', 'PemilikController@komentarpm');
Route::get('/edkomenpm={id}', 'PemilikController@edkomenpm');
Route::get('/logoutpemilik', 'PemilikController@logout');
Route::get('/dashboardpemilik', 'PemilikController@dashboard');
Route::get('/validasipemesanan', 'PemilikController@validasipemesanan');
Route::get('/validasiadmin', 'PemilikController@validasiadmin');
Route::post('/tambahadmin', 'PemilikController@tambahadmin');
Route::post('/editadmin={id}', 'PemilikController@editadmin');
Route::get('/pemilik:hapusadmin={id}', 'PemilikController@hapusadmin');
Route::get('/ubahstatus1={id}', 'PemilikController@ubahstatus1');
Route::get('/ubahstatus2={id}', 'PemilikController@ubahstatus2');
Route::post('/tambahcabang', 'PemilikController@tambahcabang');
Route::post('/editcabang={id}', 'PemilikController@editcabang');
Route::get('/pemilik:hapuscabang={id}', 'PemilikController@hapuscabang');
Route::get('/cabang', 'PemilikController@cabang');
Route::get('/jadwalproduksi', 'PemilikController@jadwalproduksi');
Route::get('/daftarbahan', 'PemilikController@daftarbahan');
Route::get('/daftarkategori', 'PemilikController@daftarkategori');
Route::get('/laporan', 'PemilikController@laporan');
Route::get('/rating', 'PemilikController@rating');
Route::get('/profilepemilik', 'PemilikController@profile');
Route::get('/produkcabang', 'PemilikController@produkcabang');
Route::get('/cekproduk', 'PemilikController@cekproduk');
//Route::get('/bahanbakupemilik', 'PemilikController@bahanbakupemilik');
Route::post('/tambahbahanbaku', 'PemilikController@tambahbahanbaku');
Route::post('/editbahan={id}', 'PemilikController@editbahan');
Route::get('/pemilik:hapusbahan={id}', 'PemilikController@hapusbahan');
Route::post('/editprofile={id}', 'PemilikController@editprofile');
Route::get('/valpelanggan', 'PemilikController@valpelanggan');
Route::post('/tambahpelanggan', 'PemilikController@tambahpelanggan');
Route::post('/editpelanggan={id}', 'PemilikController@editpelanggan');
Route::get('/pemilik:hapuspelanggan={id}', 'PemilikController@hapuspelanggan');
Route::get('/ubahstatuspel1={id}', 'PemilikController@ubahstatuspel1');
Route::get('/ubahstatuspel2={id}', 'PemilikController@ubahstatuspel2');
Route::post('/tambahproduk', 'PemilikController@tambahproduk');
Route::post('/editproduk={id}', 'PemilikController@editproduk');
Route::get('/pemilik:hapusproduk={id}', 'PemilikController@hapusproduk');
Route::get('/laporan', 'PemilikController@laporan');
Route::get('/pemilik:cetaknota={id}', 'PemilikController@cetak_nota');
Route::get('/pemilik:cetaklaporan', 'PemilikController@cetak_laporan');


//ADMINNNNNN
Route::post('/tmbhbayar={id}', 'AdminController@tmbhbayar');
Route::get('/trpemesanan', 'AdminController@trpemesanan');
Route::get('/komentaradm', 'AdminController@komentaradm');
Route::get('/edkomenadm={id}', 'AdminController@edkomenadm');
Route::get('/logoutadmin', 'AdminController@logout');
Route::get('/dashboardadmin', 'AdminController@dashboard');
Route::get('/produk', 'AdminController@produk');
Route::post('/tambahstok', 'AdminController@tambahstok');
Route::post('/editexp={id}', 'AdminController@editexp');
Route::get('/admin:hapusstok={id}', 'AdminController@hapusstok');
Route::get('/bahanbaku', 'AdminController@bahanbaku');
Route::get('/profileadmin', 'AdminController@profile');
Route::post('/editprofileadmin={id}', 'AdminController@editprofile');
Route::get('/valpelangganadm', 'AdminController@valpelanggan');
Route::post('/tambahpelangganadm', 'AdminController@tambahpelanggan');
Route::post('/editpelangganadm={id}', 'AdminController@editpelanggan');
Route::get('/admin:hapuspelangganadm={id}', 'AdminController@hapuspelanggan');
Route::get('/ubahstatuspel1adm={id}', 'AdminController@ubahstatuspel1');
Route::get('/ubahstatuspel2adm={id}', 'AdminController@ubahstatuspel2');
Route::get('/transaksi', 'AdminController@transaksi');
Route::get('/search', 'AdminController@search');
Route::get('/addcart', 'AdminController@addcart');
Route::get('/admin:hapuscart={id}', 'AdminController@hapuscart');
Route::post('/bayar', 'AdminController@bayar');
Route::post('/checkouttransaksi', 'AdminController@checkouttransaksi');
Route::get('/rekaplaporan', 'AdminController@rekaplaporan');
Route::get('/cetak_pdf', 'AdminController@cetak_pdf');
Route::get('/admin:cetaknota={id}', 'AdminController@cetak_nota');
Route::post('/tambahpelanggantr', 'AdminController@tambahpelanggantr');
Route::get('/jadwalpengiriman', 'AdminController@jadwalpengiriman');
Route::post('/updjdwl={id}', 'AdminController@updjdwl');
Route::get('/admin:cetaklaporan', 'AdminController@cetak_laporan');

//PELANGANNNNN
Route::post('/tmbhbukti={id}', 'PelangganController@tmbhbukti');
Route::get('/pembayaran', 'PelangganController@pembayaran');
Route::post('/checkoutpsn', 'PelangganController@checkoutpsn');
Route::get('/keranjang', 'PelangganController@keranjang');
Route::post('/tmbhpesan', 'PelangganController@tmbhpesan');
Route::get('/cabpemesanan', 'PelangganController@cabpemesanan');
Route::get('/pemesanan={id}', 'PelangganController@pemesanan');
Route::get('/hapuskomenpl={id}', 'PelangganController@hapuskomenpl');
Route::post('/postkomen', 'PelangganController@postkomen');
Route::get('/edkomenpl={id}', 'PelangganController@edkomenpl');
Route::get('/logoutpelanggan', 'PelangganController@logout');
Route::get('/dashboardpelanggan', 'PelangganController@dashboard');
Route::get('/profilepelanggan', 'PelangganController@profile');
Route::post('/editprofilepelanggan={id}', 'PelangganController@editprofile');
Route::get('/riwayatpemesanan', 'PelangganController@riwayatpemesanan');
Route::post('/ratingkomen', 'PelangganController@ratingkomen');
Route::post('/editratingkomen={id}', 'PelangganController@editratingkomen');