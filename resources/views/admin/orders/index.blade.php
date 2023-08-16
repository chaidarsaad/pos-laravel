@extends('layouts.admin')

@section('title')
    Pesanan
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Pesanan</h2>
            <p class="dashboard-subtitle">
                List Transaksi
            </p>
            <a href="{{ url('export-pdf') }}" class="btn btn-primary mb-4">Cetak Laporan Penjualan</a>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                    <tr>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Nomor Pesanan</th>
                                            <th>Total Harga</th>
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>{{ $item->fname }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->tracking_no }}</td>
                                                <td>Rp {{ number_format($item->total_price) }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                                                type="button" id="action' .  $item->id . '"
                                                                    data-toggle="dropdown" 
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    Aksi
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                                                <a class="dropdown-item" href="{{ url('admin/view-order/'.$item->id) }}">
                                                                    Lihat Detail
                                                                </a>
                                                                <a class="dropdown-item" href="{{ url('view-invoice/'.$item->id) }}">
                                                                    Lihat Invoice
                                                                </a>
                                                                <a class="dropdown-item" href="{{ url('print-invoice/'.$item->id) }}">
                                                                    Export Pdf
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ url('truncate-orders') }}" class="btn btn-danger">Hapus Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')
    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush