<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<!--PreLoader Ends-->

<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="{{ route('home') }}">Home</a>
                            </li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="{{ route('orders.index') }}">Orders</a>

                            </li>@if(Auth::check())
                            <li>Hello, {{ Auth::user()->hoTen }}</li>
                            @else
                            <li><a href="{{ route('login') }}">Login</a>
                            @endif
                            </li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                            <li><a href={{ route('shop.index') }}>Shop</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('shop.index') }}">Shop</a></li>
                                    <li><a href="checkout.html">Check Out</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="{{ route('ShowCart') }}">Cart</a></li>
                                </ul>
                            </li>
                            <li>
                                <div class="header-icons">
                                    <a class="shopping-cart" href="{{ route('ShowCart') }}"><i class="fas fa-shopping-cart"></i></a>
                                    <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <form action="{{ route('shop.search') }}" method="GET"> 
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" name="keywords" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

