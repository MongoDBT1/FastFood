@extends('home.layouts.master')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-lg border-0">
                <div class="card-body py-5">
                    <!-- Icon thành công -->
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#28a745" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 5.03 6.97a.75.75 0 1 0-1.06 1.06l2.5 2.5z"/>
                        </svg>
                    </div>
                    <!-- Tiêu đề -->
                    <h2 class="mb-3">Đặt Hàng Thành Công!</h2>
                    <!-- Thông điệp -->
                    <p class="mb-4">Cảm ơn bạn đã đặt hàng. Chúng tôi đã nhận được đơn hàng của bạn và sẽ xử lý trong thời gian sớm nhất.</p>
                    <!-- Nút điều hướng -->
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary me-3">Tiếp tục mua sắm</a>
                        <a href="#" class="btn btn-outline-secondary">Xem đơn hàng</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
