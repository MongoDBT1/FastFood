@extends('home.layouts.master')
@section('content')
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>Check Out Product</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- check out section -->
<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                      <div class="card single-accordion">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Billing Address
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <div class="billing-address-form">
                                <form action="{{ route('checkout.update') }}" method="post" id="form-checkout">
                                    @csrf
                                    <p><input type="text" name="name" placeholder="Name" value="{{Auth::user()->hoTen}}"></p>
                                    <p><input type="email" name="email" placeholder="Email" value="{{Auth::user()->email}}"></p>
                                    <p><input type="tel" name="phone" placeholder="Phone" value="{{Auth::user()->soDienThoai}}"></p>
                                    <p><textarea name="note" id="bill" cols="30" rows="10" placeholder="Ghi chú"></textarea></p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card single-accordion">
                        <div class="card-header" id="headingTwo">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Shipping Address
                            </button>
                          </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                            <div class="shipping-address-form">
                              <p><input type="text" name="tendiachi" placeholder="Tên địa chỉ" ></p>
                              <p><input type="text" name="sonha" placeholder="Số nhà" ></p>
                              <p><input type="text" name="duong" placeholder="Đường" ></p>
                              <p><input type="text" name="phuong" placeholder="Phường" ></p>
                              <p><input type="text" name="quan" placeholder="Quận" ></p>
                              <p><input type="text" name="thanhpho" placeholder="Thành phố" ></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card single-accordion">
                        <div class="card-header" id="headingThree">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Cart Details
                            </button>
                          </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                          <div class="card-body">
                            <div class="card-details">
                              <div class="cart-table-wrap">
                                  <table class="cart-table">
                                    <thead class="cart-table-head">
                                        <tr class="table-head-row">
                                            <th class="product-name">Name</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @php $subtotal = 0; @endphp
                                      @foreach($cart as $nhaHangId => $items)
                                        @foreach($items as $index => $item)
                                          @php
                                            $totalPrice = $item['price'] * $item['quantity'];
                                            $subtotal += $totalPrice;
                                          @endphp
                                          <tr class="table-body-row">
                                            <td class="product-name">{{ $item['name'] }}</td>
                                            <td class="product-quantity">{{ $item['quantity']}} </td>
                                            <td class="product-price">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                                            <td class="product-total">{{ number_format($totalPrice, 0, ',', '.') }}đ</td>
                                          </tr>
                                          <input type="hidden" name="nhaHangId[]" value="{{ $nhaHangId }}">
                                        @endforeach
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="order-details-wrap">
                    <table class="order-details">
                        <thead>
                            <tr>
                                <th><strong>Your order Details</strong></th>
                                <th><strong>Price</strong></th>
                            </tr>
                        </thead>
                        <tbody class="order-details-body">
                            <tr>
                                <td><strong>Product</strong></td>
                                <td><strong>Total</strong></td>
                            </tr>
                            @php $subtotal = 0; @endphp
                            @foreach($cart as $nhaHangId => $items)
                              @foreach($items as $index => $item)
                                @php 
                                  $totalPrice = $item['price'] * $item['quantity'];
                                  $subtotal += $totalPrice;
                                @endphp
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ number_format($totalPrice, 0, ',', '.') }}đ</td>
                                </tr>
                              @endforeach
                            @endforeach
                        </tbody>

                        <tbody class="checkout-details">
                            <tr>
                                <td><strong>Total</strong></td>
                                <td>{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                                <p style="visibility: hidden;"><input type="text" name="subtotal" value="{{ $subtotal  }}"></p>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                    <button type="submit" name="submit" id="btn-submit" class="btn primary-btn" style="border: black 1px solid; background-color:orange"
                                onclick="document.querySelector('#form-checkout').submit()">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end check out section -->

@endsection
