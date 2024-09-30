<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\NhaHang;
use Illuminate\Http\Request;

class CartController extends Controller
{

    
public function showCart()
{
    
    return view('ShoppingCart.ShowCart');
}

}
