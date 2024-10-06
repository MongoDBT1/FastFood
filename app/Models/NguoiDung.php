<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class NguoiDung extends Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    protected $connection = 'mongodb';
    protected $collection = 'NguoiDung';

    protected $fillable = [
        'hoTen', 'email', 'soDienThoai', 'diaChi', 'matKhau', 'vaiTro'
    ];

    protected $hidden = [
        'matKhau', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->matKhau;
    }
}
