@extends('home.layouts.master')
@section('content')
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove"></th>
                                <th class="product-image">Product Image</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach($cart as $nhaHangId => $items)
                                @foreach($items as $index => $item)
                                    @php
                                        $totalPrice = $item['price'] * $item['quantity'];
                                        $subtotal += $totalPrice;
                                    @endphp
                                    <tr class="table-body-row">
                                        <td class="product-remove">
                                            <form action="{{ route('cart.remove', [$nhaHangId, $index]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-link"><i class="far fa-window-close"></i></button>
                                            </form>
                                        </td>
                                        <td class="product-image">
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                                        </td>
                                        <td class="product-name">{{ $item['name'] }}</td>
                                        <td class="product-price">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                                        <td class="product-quantity">
                                            <form action="{{ route('cart.update', [$nhaHangId, $index]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="product-total">{{ number_format($totalPrice, 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td>{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-buttons">
                        <a href="#" class="boxed-btn">Update Cart</a>
                        <a href="{{route('Checkout')}}" class="boxed-btn black">Check Out</a>
                    </div>
                </div>

                <div class="coupon-section">
                    <h3>Apply Coupon</h3>
                    <div class="coupon-form-wrap">
                        <form action="index.html">
                            <p><input type="text" placeholder="Coupon"></p>
                            <p><input type="submit" value="Apply"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end cart -->

@endsection
