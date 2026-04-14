<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Termwind\Components\Raw;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.index');
    Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/history', [BookingController::class, 'history'])->name('booking.history');
});

Route::get('/admin/schedules/create', [AdminScheduleController::class, 'create']);
Route::post('/admin/schedules/store', [AdminScheduleController::class, 'store']);
Route::get('/admin/schedules/edit/{id}', [AdminScheduleController::class, 'edit']);
Route::match(['post', 'put'], '/admin/schedules/update/{id}', [AdminScheduleController::class, 'update']);
Route::get('/admin/schedules/delete/{id}', [AdminScheduleController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
    Route::post('/admin/bookings/{id}/confirm', [AdminBookingController::class, 'confirm']);
});

Route::get('/konfirmasi/{id}', [BookingController::class, 'konfirmasi']);
Route::post('/bayar/{id}', [BookingController::class, 'bayar']);
Route::get('/invoice/{id}', [BookingController::class, 'invoice']);
