<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhaHang;
use App\Models\donhang;
use Carbon\Carbon;

class DashboardController extends Controller
{   
    public function index()
    {
        $nhaHangs = NhaHang::all();
        $donHangs = donhang::where('trangThai', 'DaGiao')->get(); 
        
        $quantityBill = $donHangs->count();
        $quantityUser = $donHangs->pluck('khachHang')->unique()->count();

        $quantityProduct = $donHangs->flatMap(function ($dh) {
                                return collect($dh->danhSachMon)->pluck('soLuong'); 
                            })->sum();
        
        $totalBill = $donHangs->sum('tongTien');
        
        return view('admin.index.home', compact('quantityBill', 'quantityUser', 'quantityProduct', 'totalBill'));
    }

    public function getChartData(Request $request) 
    {
        $year = $request->input('year', date('Y')); // Mặc định là năm hiện tại

        $chartData = donhang::where('trangThai', 'DaGiao')->get()->filter(function ($dh) use ($year) {
            return (new \Carbon\Carbon($dh->thoiGianGiao))->format('Y') == $year; // Lọc theo năm
        })->map(function ($dh) {
            $month = (new \Carbon\Carbon($dh->thoiGianGiao))->format('m');
            return [
                'month' => $month,
                'total' => (float) $dh->tongTien,
            ];
        });

        $groupedData = $chartData->groupBy('month')->map(function ($group) {
            return [
                'month' => $group->first()['month'],
                'total' => $group->sum('total'),
            ];
        })->values();

        return response()->json(['data' => $groupedData], 200);
    }

    public function getChartCategories()
    {
        $datas = donhang::where('trangThai', 'DaGiao')->get()->flatMap(function ($dh) {
            return collect($dh->danhSachMon)->map(function ($mon) {
                return [
                    'loaiMon' => $mon['loaiMon'],
                    'soLuong' => $mon['soLuong'],
                ];
            });
        });
        $groupedData = $datas->groupBy('loaiMon')->map(function ($group) {
            return $group->sum('soLuong');
        });
        $total = $groupedData->sum();
        $chartData = $groupedData->map(function ($count, $name) use ($total) {
            return [
                'name' => $name,
                'quantity' => $count,
                'percentage' => round(($count / $total) * 100, 2),
            ];
        })->values();
        return response()->json(['data' => $chartData], 200);
    }

}
