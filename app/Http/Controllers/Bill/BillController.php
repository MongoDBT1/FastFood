<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function Checkout()
    {
        return view('Bill.CheckOut');
    }
    public function Success()
    {
        return view('Bill.CheckOutSuccess');
    }
}
