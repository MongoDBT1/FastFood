<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\NhaHang;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        try {
            $products = NhaHang::all();
            return view('home.index.shop', compact('products'));

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to MongoDB: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function search(Request $request)
    {
        $query = $request->input('keywords');
        
        if (!$query) {
            return redirect()->route('shop.index');
        }

        $products = NhaHang::where('menu.tenMon', 'like', '%' . $query . '%')->get();

        return view('home.index.search', compact('products'));
    }



}