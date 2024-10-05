<?php

namespace App\Enums;

class OrderStatus
{
    const CHO_XAC_NHAN = 'ChoXacNhan';
    const DANG_CHUAN_BI = 'DangChuanBi';
    const DANG_GIAO = 'DangGiao';
    const DA_GIAO = 'DaGiao';
    const DA_HUY = 'DaHuy';


    public static function getStatuses()
    {
        return [
            self::CHO_XAC_NHAN,
            self::DANG_CHUAN_BI,
            self::DANG_GIAO,
            self::DA_GIAO,
            self::DA_HUY,
        ];
    }
}
