<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class NhaHang extends Model
{
    use HasFactory;

    protected $connection = 'mongodb'; // Đã chỉ định sử dụng MongoDB
    protected $collection = 'nha_hang'; // Tên collection trong MongoDB

    protected $fillable = [
        'tenNhaHang', 'moTa', 'diaChi', 'soDienThoai', 'email', 'gioMoCua',
        'gioDongCua', 'danhGia', 'hinhAnh', 'loaiAmThuc', 'menu'
    ];


}
