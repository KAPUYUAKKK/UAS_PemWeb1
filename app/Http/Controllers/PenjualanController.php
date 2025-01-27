<?php
namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Product;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi penjualan beserta informasi produk
        $sales = Penjualan::with('product')->get();

        // Tampilkan halaman dengan data penjualan
        return view('penjualans.index', compact('sales'));
    }

    public function create()
    {
        // Ambil data produk untuk dropdown
        $products = Product::all();
        return view('penjualans.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil produk berdasarkan product_id
        $product = Product::find($validatedData['product_id']);

        // Hitung total harga
        $totalPrice = $product->price * $validatedData['quantity'];

        // Simpan transaksi penjualan ke database
        $sale = new Penjualan();
        $sale->product_id = $validatedData['product_id'];
        $sale->quantity = $validatedData['quantity'];
        $sale->total_price = $totalPrice;
        $sale->save();

        // Update stok produk (kurangi dengan jumlah yang dijual)
        $product->stock -= $validatedData['quantity'];
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->route('penjualans.index')->with('success', 'Transaksi penjualan berhasil!');
    }

    public function destroy(Penjualan $penjualan)
    {
        // Ambil produk terkait dengan transaksi penjualan
        $product = $penjualan->product;

        // Kembalikan stok produk yang terjual
        $product->stock += $penjualan->quantity;
        $product->save();

        // Hapus transaksi penjualan
        $penjualan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('penjualans.index')->with('success', 'Transaksi penjualan berhasil dihapus!');
    }
}
