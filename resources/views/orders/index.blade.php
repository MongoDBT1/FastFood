@extends('home.layouts.master')
@section('content')

<style>
    .order-management {
        padding: 120px 0 40px; /* Tăng padding-top lên 120px */
        background-color: #f8f9fa;
        min-height: 100vh;
        margin-top: -60px; /* Thêm margin-top âm nếu cần */
        position: relative; /* Thêm position relative */
        z-index: 1; /* Đảm bảo section nằm dưới header */
    }

    /* Thêm media query cho responsive */
    @media (max-width: 768px) {
        .order-management {
            padding: 100px 0 40px; /* Điều chỉnh padding cho mobile */
        }
    }




    .section-title {
        text-align: center;
        margin-bottom: 40px;
        color: #2c3e50;
        font-size: 2.5rem;
        font-weight: 600;
    }

    .order-box {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 25px;
        transition: all 0.3s ease;
        border: 1px solid #eaeaea;
    }

    .order-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f1f1;
        margin-bottom: 20px;
    }

    .order-status {
        font-weight: 600;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .status-ChoXacNhan {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-DangChuanBi {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-DangGiao {
        background-color: #d4edda;
        color: #155724;
    }

    .order-items {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin: 15px 0;
    }

    .item-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .item-entry {
        padding: 12px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .item-entry:last-child {
        border-bottom: none;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .item-options {
        font-size: 0.9rem;
        color: #666;
        padding-left: 15px;
    }

    .item-price {
        color: #e74c3c;
        font-weight: 600;
    }

    .action-buttons {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-cancel {
        background-color: #ff4757;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #ff6b81;
    }

    .btn-receive {
        background-color: #2ed573;
        color: white;
    }

    .btn-receive:hover {
        background-color: #7bed9f;
    }

    .total-price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        text-align: right;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 2px dashed #eee;
    }
</style>

<section class="order-management">
    <div class="container">
        <h2 class="section-title">Quản lý đơn hàng</h2>

        @forelse($orders as $order)
            <div class="order-box">
                <div class="order-header">
                    <div class="order-status status-{{ $order->trangThai }}">
                        {{ trans('Trạng Thái: ' . $order->trangThai) }}
                    </div>
                    <div class="order-dates">
                        <div class="order-date">
                            <strong>Thời gian đặt:</strong>
                            {{ date('d/m/Y H:i', strtotime($order->thoiGianDat)) }}
                        </div>
                        @if($order->thoiGianGiao)
                        <div class="order-date">
                            <strong>Thời gian giao:</strong>
                            {{ date('d/m/Y H:i', strtotime($order->thoiGianGiao)) }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="order-items">
                    @if(count($order->danhSachMon) > 0)
                        <ul class="item-list">
                            @foreach($order->danhSachMon as $mon)
                                <li class="item-entry">
                                    <div class="item-details">
                                        <div class="item-name">
                                            {{ $mon['tenMon'] }} x {{ $mon['soLuong'] }}
                                        </div>
                                        @if(count($mon['tuyChonDaChon']) > 0)
                                            <div class="item-options">
                                                @foreach($mon['tuyChonDaChon'] as $tuyChon)
                                                    <div>+ {{ $tuyChon['tenTuyChon'] }}
                                                        <span class="option-price">({{ number_format($tuyChon['giaBoSung'], 0, ',', '.') }} ₫)</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="item-price">
                                        {{ number_format($mon['tongGia'], 0, ',', '.') }} ₫
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total-price">
                            Tổng cộng: {{ number_format($order->tongTien, 0, ',', '.') }} ₫
                        </div>
                    @else
                        <p class="text-center">Không có món ăn nào trong đơn hàng.</p>
                    @endif
                </div>

                <div class="action-buttons">
                    @if($order->trangThai == 'ChoXacNhan' || $order->trangThai == 'DangChuanBi')
                        <form action="{{ route('orders.cancel', $order->_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-cancel">Hủy đơn</button>
                        </form>
                    @endif

                    @if($order->trangThai == 'DangGiao')
                        <form action="{{ route('orders.receive', $order->_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-receive">Đã nhận hàng</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center">
                <p>Bạn chưa có đơn hàng nào.</p>
            </div>
        @endforelse
    </div>
</section>

@endsection
