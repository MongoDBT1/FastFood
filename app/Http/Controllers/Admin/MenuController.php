<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NhaHang;
use Exception;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function ListMenu() {
        $nhahang = session('nhaHangId');
        $nh= NhaHang::find($nhahang);
        $menuItem = [];
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
    return view('admin.index.Menu', compact('menuItem'));
    }

    public function deleteMenuItem($menuIndex) {
        $nhahang = session('nhaHangId');
        $nh = NhaHang::find($nhahang);

        $menu = $nh->menu; // Lấy giá trị menu
    if (isset($menu) && is_array($menu)) {
        if (isset($menu[$menuIndex])) {
            unset($menu[$menuIndex]);
            $nh->menu = array_values($menu);
            $nh->save();
            return redirect()->back()->with('success', 'Món ăn đã được xóa thành công.');
        } else {
            return redirect()->back()->with('error', 'Món ăn không tồn tại.');
        }
    }
    }
    public function editMenuItem(Request $request, $menuIndex) {
        $nhahang = session('nhaHangId');
        $nh = NhaHang::find($nhahang);
        $menu = $nh->menu;
        if (isset($menu) && is_array($menu)) {
            if (isset($menu[$menuIndex])) {
                $request->validate([
                    'tenMon' => 'required|string|max:255',
                    'gia' => 'required|numeric|min:0',
                ]);

                $menu[$menuIndex]['tenMon'] = $request->input('tenMon');
                $menu[$menuIndex]['gia'] = $request->input('gia');
                $nh->menu = array_values($menu);
                $nh->save();
                return redirect()->back()->with('success', 'Món ăn đã được cập nhật thành công.');
            }
        }
        return redirect()->back()->with('error', 'Món ăn không tồn tại.');
    }

public function addMenuItem(Request $request) {
    $nhahang = session('nhaHangId');
    $nh = NhaHang::find($nhahang);

    $request->validate([
        'tenMon' => 'required|string|max:255',
        'gia' => 'required|numeric|min:0',
        'hinhAnh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'moTa' => 'nullable|string|max:255',
        'loaiMon' => 'required|string|max:255', // Validation cho loại món
        'tuyChon' => 'nullable|string|max:255', // Validation cho tùy chọn
    ]);

    $menu = $nh->menu ?? []; // Nếu menu không tồn tại, khởi tạo nó như một mảng rỗng
    foreach ($menu as $item) {
        if ($item['tenMon'] === $request->input('tenMon')) {
            return redirect()->back()->with('error', 'Món ăn đã tồn tại trong menu.');
        }
    }
    $newItem = [
        'tenMon' => $request->input('tenMon'),
        'gia' => $request->input('gia'),
        'hinhAnh' => $request->file('hinhAnh')->store('images', 'public'),
        'moTa' => $request->input('moTa'),
        'loaiMon' => $request->input('loaiMon'),
        'tuyChon' => $request->input('tuyChon'),
    ];

    $menu[] = $newItem;
    $nh->menu = $menu;
    if ($nh->save()) {
        return redirect()->back()->with('success', 'Món ăn đã được thêm thành công.');
    } else {
        return redirect()->back()->with('error', 'Có lỗi xảy ra khi lưu.');
    }
}



}
