@extends('home.layouts.master')  
@section('content')

<!--PreLoader-->
<div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
                        <h3>Search Results for "{{ request()->input('keywords') }}"</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row product-lists">
            @forelse ($products as $product)
                @foreach ($product->menu as $item)
                    @if (stripos($item['tenMon'], request()->input('keywords')) !== false) <!-- Sử dụng keywords từ request -->
                    <div class="col-lg-4 col-md-6 text-center {{ strtolower($item['loaiMon'] ?? 'no-category') }}">
                        <a href="{{ route('detail', ['nhaHangId' => $product['_id'], 'menuIndex' => $loop->index]) }}">
                        <div class="single-product-item">
                            <div class="product-image">
                                <h4>Nhà hàng: {{ $product['tenNhaHang'] }}</h4>
                                <img src="{{ asset('assets_home/img/products/' . ($item['hinhAnh'] ?? 'default.jpg')) }}" 
                                    alt="{{ $item['tenMon'] ?? 'Không có tên món' }}" 
                                    class="img-fluid" 
                                    style="width: 200px; height: 200px;">
                            </div>
                            <h3>{{ $item['tenMon'] ?? 'Tên món không có' }}</h3> 
                            <p class="product-price">{{ $item['gia'] ?? 'Giá không có' }} VNĐ</p>  
                        </div>
                    </div>
                    @endif
                @endforeach
            @empty
                <p>No results found for "{{ request()->input('keywords') }}".</p>
            @endforelse
        </div>
    </div>
</div>


@endsection
