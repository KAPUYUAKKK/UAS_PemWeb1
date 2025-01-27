<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total barang
        $totalBarang = Product::sum('stock');
        // Hitung total penjualan (total harga dari semua transaksi penjualan)
        $totalPenjualan = Penjualan::count();

        // Hitung jumlah pengguna
        $totalUsers = User::count();

        return view('dashboard', [
            'totalBarang' => $totalBarang,
            'totalPenjualan' => $totalPenjualan,
            'totalUsers' => $totalUsers,
        ]);
    }
}
