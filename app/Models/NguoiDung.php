<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class NguoiDung extends Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    protected $connection = 'mongodb';
    protected $collection = 'NguoiDung';  // Tên collection trong MongoDB

    protected $fillable = [
        'hoTen', 'email', 'soDienThoai', 'matKhau', 'vaiTro'
    ];

    protected $hidden = [
        'matKhau', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->matKhau;
    }
}
