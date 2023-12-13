<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CustomerAdminController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

//Untuk Search
Route::get('/users/search', [HomeController::class, 'search'])->name('users.search');


//Untuk Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Untuk Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'create'])->name('create.account');

//profil customer
Route::prefix('profil')->group(function () {
    // Semua rute dalam grup ini akan memiliki awalan 'admin'
    Route::get('/', [CustomerController::class, 'profil'])->name('profil');
    Route::post('update/{id}', [CustomerController::class, 'update_profil'])->name('profil.update');
});

Route::prefix('pemesanan')->middleware('auth')->group(function () {
    // Semua rute dalam grup ini akan memiliki awalan 'admin'
    Route::get('{id}', [PemesananController::class, 'index'])->name('pemesanan');
    Route::post('beli_tiket/{id}', [PemesananController::class, 'beli_tiket'])->name('pemesanan.beli_tiket');

    Route::get('batal/{id}', [PemesananController::class, 'batal'])->name('pemesanan.batal');

    // Route::post('update/{id}', [CustomerController::class, 'update_profil'])->name('profil.update');
});

Route::prefix('pembayaran')->middleware('auth')->group(function () {
    // Semua rute dalam grup ini akan memiliki awalan 'admin'
    Route::get('/', [PemesananController::class, 'pembayaran'])->name('pembayaran');
    Route::post('bayar_tiket', [PemesananController::class, 'bayar_tiket'])->name('pembayaran.bayar_tiket');
    Route::get('refund/{id}', [PemesananController::class, 'refund'])->name('pembayaran.refund');
});

Route::prefix('riwayat_transaksi')->middleware('auth')->group(function () {
    // Semua rute dalam grup ini akan memiliki awalan 'admin'
    Route::get('/', [PemesananController::class, 'riwayat_transaksi'])->name('riwayat_transaksi');
    // Route::post('bayar_tiket', [PemesananController::class, 'bayar_tiket'])->name('pembayaran.bayar_tiket');
});

//Untuk Admin

// use App\Http\Controllers\CustomerController;

Route::middleware(['web', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboards'])->name('admin.dashboards');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');




    Route::get('admin/events', [EventController::class, 'index'])->name('admin.events');
    Route::get('admin/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('admin/events', [EventController::class, 'store'])->name('events.store');
    Route::get('admin/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('admin/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('admin/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('admin/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');


    Route::get('admin/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('admin/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('admin/customers/create', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('admin/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('admin/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('admin/customers/{id}/edit', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('admin/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});
