@extends('backend.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Edit Data
                    </div>
                    <h2 class="page-title">
                        Edit Barang
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xl mt-5">
        <div class="row row-deck row-cards">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Barang</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Barang</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="Rp. {{ number_format($product->price, 0, ',', '.') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Barang</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Barang</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Image" style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const hargaInput = document.getElementById('price');
        hargaInput.addEventListener('input', function (e) {
            let inputVal = e.target.value;
            inputVal = inputVal.replace(/[^0-9]/g, '');  // remove non-numeric characters
            inputVal = new Intl.NumberFormat('id-ID').format(inputVal); // format as currency
            e.target.value = 'Rp. ' + inputVal;
        });
    </script>
@endsection
