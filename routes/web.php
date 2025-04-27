<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ChildController::class, 'create']);
Route::post('/register', [ChildController::class, 'store'])->name('child.register');
