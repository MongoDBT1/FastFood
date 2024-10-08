@extends('admin.layouts.master')
@section('content')
<div class="card" style="margin-top: 32px;">
    <div class="card-header">
        <h1>Chi tiết đơn hàng</h1>
    </div>
    <div class="card-body">
        <h5 class="card-title">Khách hàng: {{ $donHang->khachHang['hoTen'] }}</h5>
        <p class="card-text">
            Địa chỉ: {{ $donHang->diaChiGiao['soNha'] }} {{ $donHang->diaChiGiao['duong'] }}<br>
            Tổng tiền: {{ number_format($donHang->tongTien) }} VND <br>
            Ngày đặt: {{ $donHang->thoiGianDat }} <br>
            Ghi chú: {{ $donHang->ghiChu }} <br>
        </p>
        <div class="status">
            <h3>Trạng thái: {{ $donHang->trangThai }}</h3>
        </div>
    </div>
</div>
@if ($donHang->trangThai == 'ChoXacNhan')
<div class="status-buttons">
    <form action="{{ route('admin.orders.update-status', $donHang->_id) }}" method="POST">
        @csrf
        <button type="submit" name="trangThai" value="DangChuanBi" class="btn btn-success">Xác nhận đơn hàng</button>
    </form>
</div>
@elseif ($donHang->trangThai == 'DangChuanBi')
<div class="status-buttons">
    <form action="{{ route('admin.orders.update-status', $donHang->_id) }}" method="POST">
        @csrf
        <button type="submit" name="trangThai" value="DangGiao" class="btn btn-warning">Cập nhật trạng thái: Đang giao</button>
    </form>
</div>
@elseif ($donHang->trangThai == 'DangGiao')
<p class="text-info">Đơn hàng đang được giao.</p>
@elseif ($donHang->trangThai == 'DaGiao')
<p class="text-info">Đơn hàng đã được giao.</p>
@elseif ($donHang->trangThai == 'DaHuy')
<p class="text-danger">Đơn hàng đã bị hủy.</p>
@endif
</div>
@endsection