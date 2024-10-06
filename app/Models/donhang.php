<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Enums\OrderStatus;
class donhang extends Model
{
    use HasFactory;
    protected $collection='don_hang';   
    protected $fillable = ['khachHang', 'trangThai', 'diaChiGiao',
        'thoiGianDat', 'thoiGianGiao', 'tongTien', 'phuongThucThanhToan',
        'ghiChu', 'danhSachMon', 'nhanVienGiao'];

        public function setTrangThaiAttribute($value)
        {
            if (!in_array($value, OrderStatus::getStatuses())) {
                throw new \InvalidArgumentException("Trạng thái không hợp lệ.");
            }
            $this->attributes['trangThai'] = $value;
        }
}
