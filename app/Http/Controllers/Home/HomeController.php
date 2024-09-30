<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\NhaHang;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
{
    try {
        $nhaHang = NhaHang::all();
        $menuItem = [];

        foreach ($nhaHang as $nh) {
            if (isset($nh->menu) && is_array($nh->menu)) {
                foreach ($nh->menu as $index => $monAn) { // Thêm biến $index
                    if (isset($monAn['tenMon'], $monAn['moTa'], $monAn['gia'], $monAn['hinhAnh'], $monAn['loaiMon'], $monAn['tuyChon'])) {
                        $menuItem[] = [
                            'id' => $nh->id,
                            'menu_index' => $index, // Thêm index của món ăn
                            'tenNhaHang' => $nh->tenNhaHang,
                            'tenMon' => $monAn['tenMon'],
                            'moTa' => $monAn['moTa'],
                            'gia' => $monAn['gia'],
                            'hinhAnh' => $monAn['hinhAnh'],
                            'loaiMon' => $monAn['loaiMon'],
                            'tuyChon' => $monAn['tuyChon'],
                        ];
                    }
                }
            }
        }

        return view('home.index.home', compact('menuItem'));
    } catch (Exception $ex) {
        dd("không tồn tại");
    }
}

}
