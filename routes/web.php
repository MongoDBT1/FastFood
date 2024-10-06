<?php

use App\Http\Controllers\Bill\BillController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ShoppingCart\Cart;
use App\Http\Controllers\ShoppingCart\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\AuthController;
use App\Http\Controllers\Home\OrderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderAdminController;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/Checkout',[BillController::class,'Checkout'])->name("Checkout");
    Route::get('/Checkout/success',[BillController::class,'Success'])->name("Success");
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::post('/orders/receive/{id}', [OrderController::class, 'receiveOrder'])->name('orders.receive');

    Route::get('/admin/orders', [OrderAdminController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [OrderAdminController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/update-status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.update-status');

    Route::get('/admin/menu',[MenuController::class,'ListMenu'])->name('listmenu');
    Route::delete('/admin/menu/delete/{menuIndex}', [MenuController::class, 'deleteMenuItem'])->name('admin.menu.delete');
    Route::post('/admin/menu/edit/{menuIndex}', [MenuController::class, 'editMenuItem'])->name('admin.menu.edit');
    Route::post('/admin/menu/add', [MenuController::class, 'addMenuItem'])->name('admin.menu.add');


});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/cart/add/{nhaHangId}/{menuIndex}', [CartController::class, 'add'])->name('cart.add');

Route::get('/Cart',[CartController::class,'showCart'])->name("ShowCart");
Route::post('/cart/update/{nhaHangId}/{menuIndex}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{nhaHangId}/{menuIndex}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/detail/{nhaHangId}/{menuIndex}',[HomeController::class,'details'])->name('detail');
// Admin
Route::get('/admin', function() {
    return view('admin.index.home');
})->name('admin');






