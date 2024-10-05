<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\donhang;
use Illuminate\Support\Facades\Auth;
use App\Enums\OrderStatus;
class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng của khách hàng hiện tại
        $orders = donhang::where('khachHang.email', Auth::user()->email)->get();

        return view('orders.index', compact('orders'));
    }

    public function cancelOrder($id)
    {
        // Tìm đơn hàng và cập nhật trạng thái
        $order = donhang::find($id);
        if ($order) {
            $order->trangThai = OrderStatus::DA_HUY; // Cập nhật trạng thái thành "Đã hủy"
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
        }
        return redirect()->route('orders.index')->withErrors(['message' => 'Đơn hàng không tồn tại.']);
    }

    public function receiveOrder($id)
    {
        // Tìm đơn hàng và cập nhật trạng thái
        $order = donhang::find($id);
        if ($order) {
            $order->trangThai = OrderStatus::DA_GIAO;
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Đã nhận hàng.');
        }
        return redirect()->route('orders.index')->withErrors(['message' => 'Đơn hàng không tồn tại.']);
    }
}


