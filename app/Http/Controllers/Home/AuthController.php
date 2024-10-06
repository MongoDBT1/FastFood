<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Thêm Hash để kiểm tra mật khẩu
use App\Models\NguoiDung;
use App\Models\NhaHang; // Thêm model NhaHang

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('home.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $nguoiDung = NguoiDung::where('email', $request->email)->first();


        if ($nguoiDung) {

            if ($nguoiDung->vaiTro === 'KhachHang') {
                if (Hash::check($request->password, $nguoiDung->matKhau)) {
                    Auth::login($nguoiDung);
                    $request->session()->flash('success', 'Đăng nhập thành công');
                    return redirect()->route('home');
                } else {
                    return redirect()->back()->withErrors(['message' => 'Mật khẩu không đúng']);
                }
            }


            elseif ($nguoiDung->vaiTro === 'NhaHang') {
                if (Hash::check($request->password, $nguoiDung->matKhau)) {

                    $nhaHang = NhaHang::where('email', $nguoiDung->email)
                        ->orWhere('soDienThoai', $nguoiDung->soDienThoai)
                        ->first();


                    if ($nhaHang) {

                        Auth::login($nguoiDung);
                        session(['nhaHangId' => $nhaHang->_id]);
                        $request->session()->flash('success', 'Đăng nhập thành công');

                     dd(session('nhaHangId'));
                        return redirect()->route('admin');
                    } else {
                        return redirect()->back()->withErrors(['message' => 'Không tìm thấy nhà hàng tương ứng.']);
                    }
                } else {
                    return redirect()->back()->withErrors(['message' => 'Mật khẩu không đúng']);
                }
            }
        }

        // Nếu không tìm thấy người dùng hoặc không khớp thông tin
        return redirect()->back()->withErrors(['message' => 'Sai thông tin đăng nhập']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('home.register');
    }

    public function register(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'hoTen' => 'required|string|max:255',
            'email' => 'required|email|unique:NguoiDung,email',
            'soDienThoai' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tạo người dùng mới
        $nguoiDung = new NguoiDung();
        $nguoiDung->hoTen = $request->hoTen;
        $nguoiDung->email = $request->email;
        $nguoiDung->soDienThoai = $request->soDienThoai;
        $nguoiDung->matKhau = Hash::make($request->password);
        $nguoiDung->vaiTro = 'KhachHang'; // Mặc định đăng ký là khách hàng

        // Lưu người dùng vào database
        $nguoiDung->save();

        // Đăng nhập người dùng ngay sau khi đăng ký
        Auth::login($nguoiDung);

        // Hiển thị thông báo thành công và chuyển hướng về trang chủ
        $request->session()->flash('success', 'Đăng ký thành công');
        return redirect()->route('home');
    }
}
