<?php

namespace App\Http\Controllers\ShoppingCart;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\NhaHang;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add($nhaHangId, $menuIndex, Request $request)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$nhaHangId][$menuIndex])) {
            $cart[$nhaHangId][$menuIndex]['quantity'] += $request->input('quantity', 1);
        } else {
            $menuItem = NhaHang::find($nhaHangId)->menu[$menuIndex];
            $cart[$nhaHangId][$menuIndex] = [
                'name' => $menuItem['tenMon'],
                'price' => $menuItem['gia'],
                'quantity' => $request->input('quantity', 1),
                'image' => $menuItem['hinhAnh'],
                'loaiMon' => $menuItem['loaiMon']   
            ];
        }
        
        Session::put('cart', $cart);
        return redirect()->route('ShowCart')->with('success', 'Đã thêm món ăn vào giỏ hàng!');
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('ShoppingCart.ShowCart', compact('cart'));
    }
    public function update($nhaHangId, $menuIndex)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$nhaHangId][$menuIndex])) {
            $quantity = request()->input('quantity', 1);
            $cart[$nhaHangId][$menuIndex]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'update thành công');
        }

        return redirect()->back()->with('error', 'Không tồn tại món ăn');
    }
    public function remove($nhaHangId, $menuIndex)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$nhaHangId][$menuIndex])) {
            unset($cart[$nhaHangId][$menuIndex]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Xóa thành công');
        }

        return redirect()->back()->with('error', 'Không tồn tại món ăn');
    }



}
