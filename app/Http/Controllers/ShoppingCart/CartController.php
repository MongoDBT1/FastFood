<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {

        return view('ShoppingCart.ShowCart');
    }
}
