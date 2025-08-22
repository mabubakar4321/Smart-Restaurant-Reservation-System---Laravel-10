<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
Route::get('register',[AuthController::class,'register'])->name('register');
Route::get('login',[AuthController::class,'login'])->name('login');

Route::post('register',[AuthController::class,'saveregister'])->name('dataregister');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
});


Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

 Route::middleware('admin')->group(function () {
Route::get('admin',[AdminController::class,'admin'])->name('admin');
// Table
Route::get('tables',[TableController::class,'index'])->name('index');
Route::post('tables',[TableController::class,'store'])->name('tables.store');
Route::get('delete/{id}',[TableController::class,'destroy'])->name('tables.destroy');
Route::get('edit/{id}',[TableController::class,'edit'])->name('tables.edit');
ROute::put('update/{id}',[TableController::class,'update'])->name('tables.update');
Route::get('create',[TableController::class,'create'])->name('showcreate');

// Reservation
 Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
 Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
 Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
//Customer
Route::get('admin/customers', [CustomerController::class, 'index'])->name('customers.index');
//payments
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::put('/payments/{id}/update', [PaymentController::class, 'update'])->name('payments.update');
Route::get('/payments/{id}/delete', [PaymentController::class, 'destroy'])->name('payments.destroy');

//Reports
// Reports page
Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/reports/export/reservations', [ReportsController::class, 'exportReservations'])->name('reports.export.reservations');
Route::get('/reports/export/revenue', [ReportsController::class, 'exportRevenue'])->name('reports.export.revenue');
Route::get('/reports/export/customers', [ReportsController::class, 'exportCustomers'])->name('reports.export.customers');
//settings

     Route::get('/settings/users', [SettingController::class, 'index'])->name('settings.users');
    Route::get('/settings/users/create', [SettingController::class, 'create'])->name('settings.users.create');
    Route::post('/settings/users', [SettingController::class, 'store'])->name('settings.users.store');
    Route::get('/settings/users/{id}/edit', [SettingController::class, 'edit'])->name('settings.users.edit');
    Route::put('/settings/users/{id}', [SettingController::class, 'update'])->name('settings.users.update');
    Route::delete('/settings/users/{id}', [SettingController::class, 'destroy'])->name('settings.users.destroy');






 });
  Route::middleware('user')->group(function () {

Route::get('user',[UserController::class,'user'])->name('user');
    Route::get('/user/dashboard', [UserReservationController::class, 'index'])->name('user.dashboard');
    Route::post('/user/reservations', [UserReservationController::class, 'store'])->name('user.reservations.store');
    Route::get('/user/reservations/{reservation}/edit', [UserReservationController::class, 'edit'])->name('user.reservations.edit');
    Route::put('/user/reservations/{reservation}', [UserReservationController::class, 'update'])->name('user.reservations.update');
    Route::delete('/user/reservations/{reservation}', [UserReservationController::class, 'destroy'])->name('user.reservations.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
  });

});