<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KaderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NormalUserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/infografik', [FrontController::class, 'infografik'])->name('infografik');
Route::get('/infografik/balita', [FrontController::class, 'infografik_balita'])->name('infografik_balita');
Route::get('/artikel', [FrontController::class, 'article'])->name('article');
Route::get('/artikel/{slug}', [FrontController::class, 'article_detail'])->name('article-detail');
// Route::get('/test', [FrontController::class, 'test'])->name('test');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'redirect'])->name('home');

// Normal User
Route::prefix('user')->controller(NormalUserController::class)->middleware(['isNormalUser'])->name('user.')->group(function () {

    Route::get('/dashboard', 'dashboard')->name('dashboard');
    // balita
    Route::get('/balita', 'list_balita')->name('list_balita');
    Route::get('/balita/riwayat/{id}', 'riwayat_balita')->name('riwayat_balita');
    Route::get('/pemeriksaan_balita/detail/{id}', 'detail_pemeriksaan_balita')->name('detail_pemeriksaan_balita');

    // update profile
    Route::get('/akun/update', 'update_akun')->name('update_akun');
    Route::post('/akun/update', 'update_akun_act')->name('update_akun_act');
    Route::post('/akun/update-password}', 'update_password_act')->name('update_password_act');
});

// Kader
Route::prefix('kader')->controller(KaderController::class)->middleware(['isKader'])->name('kader.')->group(function () {

    Route::get('/dashboard', 'dashboard')->name('dashboard');

    // pemeriksaan balita
    Route::get('/pemeriksaan_balita', 'list_pemeriksaan_balita')->name('list_pemeriksaan_balita');
    Route::get('/pemeriksaan_balita/detail/{id}', 'detail_pemeriksaan_balita')->name('detail_pemeriksaan_balita');
    Route::get('/pemeriksaan_balita/periksa', 'periksa_balita')->name('periksa_balita');
    Route::post('/pemeriksaan_balita/periksa', 'periksa_balita_act')->name('periksa_balita_act');
    Route::get('/pemeriksaan_balita/update/{id}', 'update_pemeriksaan_balita')->name('update_pemeriksaan_balita');
    Route::post('/pemeriksaan_balita/update/{id}', 'update_pemeriksaan_balita_act')->name('update_pemeriksaan_balita_act');
    Route::post('/pemeriksaan_balita/delete/{id}', 'delete_pemeriksaan_balita')->name('delete_pemeriksaan_balita');
    
    // balita
    Route::get('/balita', 'list_balita')->name('list_balita');
    Route::get('/balita/tambah', 'tambah_balita')->name('tambah_balita');
    Route::post('/balita/tambah', 'tambah_balita_act')->name('tambah_balita_act');
    Route::get('/balita/update/{id}', 'update_balita')->name('update_balita');
    Route::post('/balita/update/{id}', 'update_balita_act')->name('update_balita_act');
    Route::post('/balita/delete/{id}', 'delete_balita')->name('delete_balita');

    // akun
    Route::get('/akun', 'list_akun')->name('list_akun');
    Route::get('/akun/tambah', 'tambah_akun')->name('tambah_akun');
    Route::post('/akun/tambah', 'tambah_akun_act')->name('tambah_akun_act');
    Route::get('/akun/update/{id}', 'update_akun')->name('update_akun');
    Route::post('/akun/update/{id}', 'update_akun_act')->name('update_akun_act');
    Route::post('/akun/update-password/{id}', 'update_password_act')->name('update_password_act');
    Route::post('/akun/delete/{id}', 'delete_akun')->name('delete_akun');
});

// Admin
Route::prefix('admin')->controller(AdminController::class)->middleware(['isAdmin'])->name('admin.')->group(function () {

    Route::get('/dashboard', 'dashboard')->name('dashboard');

    // posyandu
    Route::get('/posyandu', 'list_posyandu')->name('list_posyandu');
    Route::get('/posyandu/tambah', 'tambah_posyandu')->name('tambah_posyandu');
    Route::post('/posyandu/tambah', 'tambah_posyandu_act')->name('tambah_posyandu_act');
    Route::get('/posyandu/update/{id}', 'update_posyandu')->name('update_posyandu');
    Route::post('/posyandu/update/{id}', 'update_posyandu_act')->name('update_posyandu_act');
    Route::post('/posyandu/delete/{id}', 'delete_posyandu')->name('delete_posyandu');

    // balita
    Route::get('/balita', 'list_balita')->name('list_balita');
    Route::get('/balita/tambah', 'tambah_balita')->name('tambah_balita');
    Route::post('/balita/tambah', 'tambah_balita_act')->name('tambah_balita_act');
    Route::get('/balita/update/{id}', 'update_balita')->name('update_balita');
    Route::post('/balita/update/{id}', 'update_balita_act')->name('update_balita_act');
    Route::post('/balita/delete/{id}', 'delete_balita')->name('delete_balita');
    
    // akun
    Route::get('/akun', 'list_akun')->name('list_akun');
    Route::get('/akun/tambah', 'tambah_akun')->name('tambah_akun');
    Route::post('/akun/tambah', 'tambah_akun_act')->name('tambah_akun_act');
    Route::get('/akun/update/{id}', 'update_akun')->name('update_akun');
    Route::post('/akun/update/{id}', 'update_akun_act')->name('update_akun_act');
    Route::post('/akun/update-password/{id}', 'update_password_act')->name('update_password_act');
    Route::post('/akun/delete/{id}', 'delete_akun')->name('delete_akun');

    // artikel
    Route::get('/artikel', 'list_artikel')->name('list_artikel');
    Route::get('/artikel/tambah', 'tambah_artikel')->name('tambah_artikel');
    Route::post('/artikel/tambah', 'tambah_artikel_act')->name('tambah_artikel_act');
    Route::get('/artikel/update/{id}', 'update_artikel')->name('update_artikel');
    Route::post('/artikel/update/{id}', 'update_artikel_act')->name('update_artikel_act');
    Route::post('/artikel/delete/{id}', 'delete_artikel')->name('delete_artikel');

    // pemeriksaan balita
    Route::get('/pemeriksaan_balita', 'list_pemeriksaan_balita')->name('list_pemeriksaan_balita');
    Route::get('/pemeriksaan_balita/detail/{id}', 'detail_pemeriksaan_balita')->name('detail_pemeriksaan_balita');

    // galeri
    Route::get('/galeri', 'list_galeri')->name('list_galeri');
    Route::get('/galeri/tambah', 'tambah_galeri')->name('tambah_galeri');
    Route::post('/galeri/tambah', 'tambah_galeri_act')->name('tambah_galeri_act');
    Route::get('/galeri/update/{id}', 'update_galeri')->name('update_galeri');
    Route::post('/galeri/update/{id}', 'update_galeri_act')->name('update_galeri_act');
    Route::post('/galeri/delete/{id}', 'delete_galeri')->name('delete_galeri');

    // vaksin
    Route::get('/vaksin', 'list_vaksin')->name('list_vaksin');
    Route::get('/vaksin/tambah', 'tambah_vaksin')->name('tambah_vaksin');
    Route::post('/vaksin/tambah', 'tambah_vaksin_act')->name('tambah_vaksin_act');
    Route::get('/vaksin/update/{id}', 'update_vaksin')->name('update_vaksin');
    Route::post('/vaksin/update/{id}', 'update_vaksin_act')->name('update_vaksin_act');
    Route::post('/vaksin/delete/{id}', 'delete_vaksin')->name('delete_vaksin');
});