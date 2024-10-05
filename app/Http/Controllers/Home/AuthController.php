<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Thêm Hash để kiểm tra mật khẩu
use App\Models\NguoiDung;

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


        if ($nguoiDung && $nguoiDung->vaiTro === 'KhachHang') {
            if (Hash::check($request->password, $nguoiDung->matKhau)) {

                Auth::login($nguoiDung);
                $request->session()->flash('success', 'Đăng nhập thành công');
                return redirect()->route('home');
            } else {
                return redirect()->back()->withErrors(['message' => 'Mật khẩu không đúng']);
            }
        }


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

    $request->validate([
        'hoTen' => 'required|string|max:255',
        'email' => 'required|email|unique:NguoiDung,email',
        'soDienThoai' => 'required|string|max:15',
        'password' => 'required|string|min:6|confirmed',
    ]);


    $nguoiDung = new NguoiDung();
    $nguoiDung->hoTen = $request->hoTen;
    $nguoiDung->email = $request->email;
    $nguoiDung->soDienThoai = $request->soDienThoai;
    $nguoiDung->matKhau = Hash::make($request->password);
    $nguoiDung->vaiTro = 'KhachHang';

    $nguoiDung->save();

    // Đăng nhập người dùng ngay sau khi đăng ký
    Auth::login($nguoiDung);


    $request->session()->flash('success', 'Đăng ký thành công');

    return redirect()->route('home');
}

}
