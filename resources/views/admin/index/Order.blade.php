@extends('admin.layouts.master')
@section('content')
<h2>Quản lý đơn hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Địa chỉ giao</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thời gian đặt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donHang as $order)
                <tr>
                    <td>{{ $order->_id }}</td>
                    <td>{{ $order->khachHang['hoTen'] }}</td>
                    <td>{{ $order->diaChiGiao['soNha'] }} {{ $order->diaChiGiao['duong'] }}, {{ $order->diaChiGiao['phuong'] }}, {{ $order->diaChiGiao['quan'] }}</td>
                    <td>{{ number_format($order->tongTien) }} VND</td>
                    <td>{{ $order->trangThai }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($order->thoiGianDat)) }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->_id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
