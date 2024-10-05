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

public function details($nhaHangId, $menuIndex)
{
    try {
        // Tìm nhà hàng dựa trên id
        $nhaHang = NhaHang::find($nhaHangId);

        if ($nhaHang && isset($nhaHang->menu[$menuIndex])) {
            // Lấy món ăn dựa trên menu index
            $monAn = $nhaHang->menu[$menuIndex];

            return view('home.index.detail', [
                'nhaHang' => $nhaHang,
                'monAn' => $monAn,
            ]);
        } else {
            return redirect()->route('home')->with('error', 'Món ăn không tồn tại.');
        }
    } catch (Exception $ex) {
        return redirect()->route('home')->with('error', 'Lỗi khi truy xuất dữ liệu.');
    }
}

}
