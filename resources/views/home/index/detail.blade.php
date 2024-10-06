@extends('home.layouts.master')

@section('content')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Xem thêm chi tiết</p>
                    <h1>{{ $monAn['tenMon'] }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="{{ asset('path-to-images/'.$monAn['hinhAnh']) }}" alt="{{ $monAn['tenMon'] }}">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3>{{ $monAn['tenMon'] }}</h3>
                    <p class="single-product-pricing"><span>Giá</span> {{ number_format($monAn['gia']) }} VND</p>
                    <p>{{ $monAn['moTa'] }}</p>
                    <div class="single-product-form">
                        <a href="{{ route('cart.add', ['nhaHangId' => $nhaHang['_id'], 'menuIndex' => $menuIndex]) }}" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        <p><strong>Loại món: </strong>{{ $monAn['loaiMon'] }}</p>
                    </div>
                    <h4>Chia sẻ:</h4>
                    <ul class="product-share">
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single product -->
@endsection
