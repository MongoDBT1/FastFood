@extends('admin.layouts.master')

@section('css')
    <style>
        .order-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .status-buttons {
            margin-top: 15px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .text-info {
            color: #17a2b8;
            font-weight: bold;
        }

        .text-danger {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="order-details">
        <h2>Chi tiết đơn hàng</h2>

        <p><strong>Khách hàng:</strong> {{ $donHang->khachHang['hoTen'] }}</p>
        <p><strong>Địa chỉ giao:</strong> {{ $donHang->diaChiGiao['soNha'] }} {{ $donHang->diaChiGiao['duong'] }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($donHang->tongTien) }} VND</p>
        <p><strong>Trạng thái hiện tại:</strong> <span class="text-info">{{ $donHang->trangThai }}</span></p>

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
