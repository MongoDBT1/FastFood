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
						<p>Fresh and Organic</p>
						<h1>Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
                <div class="col-md-12">
					<div class="product-filters">
						<ul>
							<li class="active" data-filter="*">All</li> 
							<li data-filter=".monchinh">Món chính</li> 
							<li data-filter=".khaivi">Khai vị</li> 
							<li data-filter=".trangmieng">Tráng miệng</li> 
							<li data-filter=".nuocuong">Nước uống</li>
						</ul>
					</div>
					<div class="price-filter">
						<label for="price-sort">Sort by price:</label>
						<select id="price-sort">
							<option value="">Select</option>
							<option value="asc">Price: Low to High</option>
							<option value="desc">Price: High to Low</option>
						</select>
					</div>
                </div>	
            </div>

            <!-- Hiển thị danh sách sản phẩm -->
			<div class="row product-lists">
			@foreach ($products as $product)
				@foreach ($product->menu as $index => $item)
				<div class="col-lg-4 col-md-6 text-center {{ strtolower($item['loaiMon'] ?? 'no-category') }}">
					<a href="{{ route('detail', ['nhaHangId' => $product['_id'], 'menuIndex' => $index]) }}">
					<div class="single-product-item">
						<div class="product-image">
							<h4>Nhà hàng: {{ $product['tenNhaHang'] }}</h4>
							<img src="{{ asset('assets_home/img/products/' . ($item['hinhAnh'] ?? 'default.jpg')) }}" 
								alt="{{ $item['tenMon'] ?? 'Không có tên món' }}" 
								class="img-fluid" 
								style="width: 200px; height: 200px;">
						</div>
						<p>Loại: 
                            @if ($item['loaiMon'] === 'MonChinh')
                                Món Chính
                            @elseif ($item['loaiMon'] === 'KhaiVi')
                                Khai Vị
                            @elseif ($item['loaiMon'] === 'TrangMieng')
                                Tráng Miệng
                            @elseif ($item['loaiMon'] === 'NuocUong')
                                Nước Uống
                            @else
                                Không có loại món
                            @endif
                        </p>
                        <h3>{{ $item['tenMon'] ?? 'Tên món không có' }}</h3> 
					</a>
                        <p class="product-price">{{ $item['gia'] ?? 'Giá không có' }} VNĐ</p>  
                        <a href="{{ route('cart.add', ['nhaHangId' => $product['_id'], 'menuIndex' => $index]) }}?quantity=1"
							class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>  
                    </div>
				</div>
				@endforeach
			@endforeach
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a class="active" href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div> 
				</div> 
			</div> 
		</div> 
	</div> 
	<!-- end products --> 

@endsection

