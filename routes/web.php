<?php

use App\Http\Controllers\Bill\BillController;
use App\Http\Controllers\ShoppingCart\Cart;
use App\Http\Controllers\ShoppingCart\CartController;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    return view('home.index.home');
})->name('home');
Route::get('/Cart',[CartController::class,'show'])->name("ShowCart");
Route::get('/Checkout',[BillController::class,'Checkout'])->name("Checkout");
Route::get('/Checkout/success',[BillController::class,'Success'])->name("Success");

// Admin
Route::get('/admin', function() {
    return view('admin.index.home');
});




