
@extends('backend.master')

@section('content')
    <div class="container-xl mt-5">
        <div class="row row-deck row-cards">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Transaksi Penjualan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('penjualans.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Pilih Produk</label>
                            <select class="form-control" name="product_id" id="product_id" required>
                                <option value="">Pilih Produk</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" min="1" required>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('penjualans.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
