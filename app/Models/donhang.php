<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
class donhang extends Model
{
    use HasFactory;
    protected $collection='don_hang';
    protected $fillable = ['khachHang', 'nhaHang', 'trangThai', 'diaChiGiao',
        'thoiGianDat', 'thoiGianGiao', 'tongTien', 'phuongThucThanhToan',
        'ghiChu', 'danhSachMon', 'nhanVienGiao'];

}
