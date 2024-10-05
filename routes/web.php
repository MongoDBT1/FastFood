<?php

use App\Http\Controllers\Bill\BillController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ShoppingCart\Cart;
use App\Http\Controllers\ShoppingCart\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\AuthController;
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/Checkout',[BillController::class,'Checkout'])->name("Checkout");
    Route::get('/Checkout/success',[BillController::class,'Success'])->name("Success");
});
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/Cart',[CartController::class,'showCart'])->name("ShowCart");


Route::get('/detail/{nhaHangId}/{menuIndex}',[HomeController::class,'details'])->name('detail');
// Admin
Route::get('/admin', function() {
    return view('admin.index.home');
});




