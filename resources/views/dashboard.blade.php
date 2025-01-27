@extends('backend.master')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Dashboard
          </div>
          <h2 class="page-title">
           Penjualan Sepatu
          </h2>
        </div>
      </div>
    </div>
  </div>
<div class="container-xl mt-5">
    <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Total Barang</div>
                </div>
                <div class="h1 mb-3">{{$totalBarang}}</div>
              </div>
            </div>
          </div>

      <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Karyawan</div>
                  </div>
                  <div class="h1 mb-3">{{$totalUsers}}</div>
            </div>

        </div>

      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Total Penjualan</div>
            </div>
            <div class="h1 mb-3">{{$totalPenjualan}}</div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
