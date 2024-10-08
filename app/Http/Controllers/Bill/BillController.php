<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\Controller;
use App\Models\NhaHang;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use App\Models\donhang;
use App\Enums\OrderStatus;

class BillController extends Controller
{
    //
    public function Checkout()
    {
        $cart = Session::get('cart', []);
        return view('Bill.CheckOut', compact('cart'));
    }

    public function update(Request $request)
    {
        try {
            $cart = Session::get('cart', []);

            $donhang = new donhang();

            $donhang->khachHang = [
                'hoTen' => $request->input('name'),
                'email' => $request->input('email'),
                'soDienThoai' => $request->input('phone')
            ];

            $donhang->diaChiGiao = [
                'tenDiaChi' => $request->input('tendiachi'),
                'soNha' => $request->input('sonha'),
                'duong' => $request->input('duong'),
                'phuong' => $request->input('phuong'),
                'quan' => $request->input('quan'),
                'thanhPho' => $request->input('thanhpho')
            ];

            $donhang->trangThai = OrderStatus::CHO_XAC_NHAN;
            $donhang->thoiGianDat = Carbon::now()->toDateTimeString();
            $donhang->thoiGianGiao = '';
            $donhang->tongTien = $request->input('subtotal');
            $donhang->phuongThucThanhToan = 'TienMat';
            $donhang->ghiChu = $request->input('note');

            $danhSachMon = [];
            foreach ($cart as $nhaHangId => $items) {
                $nhaHang = NhaHang::find($nhaHangId);
                foreach ($items as $item) {
                    $danhSachMon[] = [
                        'tenMon' => $item['name'],
                        'loaiMon' => $item['loaiMon'],
                        'soLuong' => (int) $item['quantity'],
                        'gia' => $item['price'],
                        'tongGia' => $item['price'] * (int) $item['quantity'],
                        'tuyChonDaChon' => [],
                        'nhaHang' => [
                            'tenNhaHang' => $nhaHang['tenNhaHang'],
                            'diaChi' => [
                                'soNha' => $nhaHang['diaChi']['soNha'],
                                'duong' => $nhaHang['diaChi']['duong'],
                                'phuong' => $nhaHang['diaChi']['phuong'],
                                'quan' => $nhaHang['diaChi']['quan'],
                                'thanhPho' => $nhaHang['diaChi']['thanhPho']
                            ],
                            'soDienThoai' => $nhaHang['soDienThoai']
                        ]
                    ];
                }
            }

            $donhang->danhSachMon = $danhSachMon;

            $donhang->save();

            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại!']);
        }
    }

    public function Success()
    {
        Session::forget('cart');
        return view('Bill.CheckOutSuccess');
    }
}
