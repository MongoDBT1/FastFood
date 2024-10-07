<?php

use App\Http\Controllers\Bill\BillController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ShoppingCart\Cart;
use App\Http\Controllers\ShoppingCart\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\AuthController;
use App\Http\Controllers\Home\OrderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Home\ProductController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\DashboardController;

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Check out
Route::middleware(['auth'])->group(function () {
    Route::get('/Checkout',[BillController::class,'Checkout'])->name("Checkout");
    Route::post('/Checkout/update', [BillController::class,'update'])->name("checkout.update");
    Route::get('/Checkout/success',[BillController::class,'Success'])->name("checkout.success");
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::post('/orders/receive/{id}', [OrderController::class, 'receiveOrder'])->name('orders.receive');

    Route::get('/admin/orders', [OrderAdminController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [OrderAdminController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/update-status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
    Route::get('/admin/get-chart-data', [DashboardController::class, 'getChartData'])->name('admin.getChartData');
    Route::get('/admin/get-chart-categories', [DashboardController::class, 'getChartCategories'])->name('admin.getChartCategories');


    Route::get('/admin/menu',[MenuController::class,'ListMenu'])->name('listmenu');
    Route::delete('/admin/menu/delete/{menuIndex}', [MenuController::class, 'deleteMenuItem'])->name('admin.menu.delete');
    Route::post('/admin/menu/edit/{menuIndex}', [MenuController::class, 'editMenuItem'])->name('admin.menu.edit');
    Route::post('/admin/menu/add', [MenuController::class, 'addMenuItem'])->name('admin.menu.add');
});

// Shopping Cart
Route::get('/cart/add/{nhaHangId}/{menuIndex}', [CartController::class, 'add'])->name('cart.add');

Route::get('/Cart',[CartController::class,'showCart'])->name("ShowCart");
Route::post('/cart/update/{nhaHangId}/{menuIndex}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{nhaHangId}/{menuIndex}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/detail/{nhaHangId}/{menuIndex}',[HomeController::class,'details'])->name('detail');

// Home
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/shop', [ProductController::class, 'getAllProducts'])->name('shop.index');
Route::get('/search', [ProductController::class, 'search'])->name('shop.search');




