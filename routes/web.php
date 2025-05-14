<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\PickupLoginController;
use App\Http\Controllers\SchoolController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/create', [ChildController::class, 'create']);
Route::post('/register', [ChildController::class, 'store'])->name('child.register');
Route::get('/pickup-login', [PickupLoginController::class, 'showLoginForm'])->name('pickup.login.form');
Route::post('/pickup-send-otp', [PickupLoginController::class, 'sendOtp'])->name('pickup.send.otp');
Route::get('/verify-otp', [PickupLoginController::class, 'showOtpForm'])->name('pickup.otp.form');
Route::post('/verify-otp', [PickupLoginController::class, 'verifyOtp'])->name('pickup.verify.otp');
Route::get('/profile', [ChildController::class, 'profile'])->name('child.profile');
Route::get('/school-login', [SchoolController::class, 'schoologin'])->name('school-login');
Route::post('/confirm-login', [SchoolController::class, 'confirmlogin'])->name('confirm-login');
Route::post('/logout', [SchoolController::class, 'logout'])->name('logout');

