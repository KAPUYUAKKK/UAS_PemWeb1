<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        // Proses upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Simpan data ke database
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->image = $imagePath;
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string', // Keep it as string for now to allow currency formatting
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Format price: remove non-numeric characters (Rp., commas)
        $price = preg_replace('/[^0-9]/', '', $validatedData['price']); // Remove all non-numeric characters
        $validatedData['price'] = (int)$price; // Convert to integer

        // Proses upload gambar jika ada
        $imagePath = $product->image; // Default gambar yang lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::exists('public/'.$product->image)) {
                Storage::delete('public/'.$product->image);
            }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Update data produk
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }



    public function destroy(Product $product)
    {
        // Cek jika ada gambar yang perlu dihapus
        if ($product->image && Storage::exists('public/'.$product->image)) {
            Storage::delete('public/'.$product->image);
        }

        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk beserta gambar berhasil dihapus!');
    }

}
