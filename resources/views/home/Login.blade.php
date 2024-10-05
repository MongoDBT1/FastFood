@extends('home.layouts.master')
@section('content')

<style>
.login_box_area {
    padding: 80px 0;
    background-color: #f9f9f9;
}

.login_form_inner {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.login_box_img img {
    border-radius: 10px;
    transition: transform 0.5s ease;
}

.login_box_img:hover img {
    transform: scale(1.05);
}

.login_form_inner h3 {
    font-size: 24px;
    font-weight: bold;
}

.primary-btn {
    background-color: #007bff;
    border: none;
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 5px;
}

.primary-btn:hover {
    background-color: #0056b3;
    color: white;
}

.alert-danger {
    font-size: 14px;
    padding: 10px;
    margin-top: 20px;
}
</style>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gap">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="img/login.jpg" alt="">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="primary-btn" href="{{ route('register') }}">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" action="{{ route('login') }}" method="post" >
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" type="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>

                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Log In</button>

                        </div>
                        @if ($errors->any())
                        <div>
                    <strong>{{ $errors->first() }}</strong>
        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>// custom.js
    document.addEventListener("DOMContentLoaded", function() {
        // Hiệu ứng hover cho ảnh login
        const loginImage = document.querySelector('.login_box_img img');
        loginImage.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        loginImage.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    </script>
@endsection
