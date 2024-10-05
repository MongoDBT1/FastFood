@extends('home.layouts.master')
@section('content')

<style>
.register_box_area {
    padding: 80px 0;
    background-color: #f9f9f9;
}

.register_form_inner {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.register_box_img img {
    border-radius: 10px;
    transition: transform 0.5s ease;
}

.register_box_img:hover img {
    transform: scale(1.05);
}

.register_form_inner h3 {
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

<!--================Register Box Area =================-->
<section class="register_box_area section_gap">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="register_box_img">
                    <img class="img-fluid" src="img/register.jpg" alt="">
                    <div class="hover">
                        <h4>Already have an account?</h4>
                        <p>If you have an account, log in to access your account.</p>
                        <a class="primary-btn" href="{{ route('login') }}">Log In</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="register_form_inner">
                    <h3>Create an Account</h3>
                    <form class="row register_form" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="hoTen" placeholder="Họ Tên" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="soDienThoai" placeholder="Số Điện Thoại" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Mật Khẩu" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Xác Nhận Mật Khẩu" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Đăng Ký</button>
                        </div>
                        @if ($errors->any())
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
