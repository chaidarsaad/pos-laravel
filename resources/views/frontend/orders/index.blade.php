@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Pesanan Saya</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal Pesan</th>
                                    <th>Nomor Pesanan</th>
                                    <th>Total Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>Rp {{ number_format($item->total_price) }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->status_pesanan }}</td>
                                        {{-- <td>{{ $item->status == '0'?'PESANAN SIAP, SILAHKAN AMBIL DI TOKO' : 'DIANTARKAN KE ALAMAT TUJUAN'}}</td> --}}
                                        {{-- <td>{{ $item->status == '0'?'PROSES' : 'PESANAN SIAP, SILAHKAN AMBIL DI TOKO', 'DIANTARKAN KE ALAMAT TUJUAN'}}</td> --}}
                                        <td>
                                            <a href="{{ url('view-order/'.$item->id) }}" class="btn btn-primary">Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
