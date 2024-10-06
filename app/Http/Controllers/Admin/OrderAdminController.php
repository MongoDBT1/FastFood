<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\donhang;
use App\Models\NhaHang;

class OrderAdminController extends Controller
{
    public function index(Request $request)
    {
        $nhaHangId = session('nhaHangId');
        $nhaHang = NhaHang::find($nhaHangId);
        // Truy xuất tất cả đơn hàng liên quan đến nhà hàng đang đăng nhập
        $donHang = donhang::where('danhSachMon.nhaHang.tenNhaHang', $nhaHang->tenNhaHang)->get();
        return view('admin.index.Order', ['donHang' => $donHang]);
    }
    public function show($id)
    {
        $donHang = donhang::find($id);

        return view('admin.index.show', ['donHang' => $donHang]);
    }
    public function updateStatus(Request $request, $id)
    {
        $donHang = donhang::find($id);
        $donHang->trangThai = $request->trangThai;
        $donHang->save();

        return redirect()->route('admin.orders.show', $id)->with('success', 'Cập nhật trạng thái thành công');
    }

}
