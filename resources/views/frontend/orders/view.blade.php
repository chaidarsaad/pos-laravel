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
                        <h4 class="text-white">{{ $orders->tracking_no }}
                            <a href="{{ url('my-orders') }}" class="btn btn-warning float-end">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 order-details">
                                <h4>Detail Pesanan</h4>
                                <hr>
                                <label for="">Nama Lengkap</label>
                                <div class="border">{{ $orders->fname }}</div>
                                <label for="">No WhatsApp</label>
                                <div class="border">{{ $orders->phone }}</div>
                                <label for="">Metode Pengambilan Kue</label>
                                <div class="border">{{ $orders->status_pickup }}</div>
                                <label for="">Kecamatan</label>
                                <div class="border">{{ $userd->district->name }}</div>
                                <label for="">Alamat Lengkap</label>
                                    <div class="border">{{ $userd->address1 }}</div>
                                {{-- <label for="">Alamat Lengkap</label>
                                <div class="border">
                                    {{ $orders->address1 }}<br>
                                    {{ $orders->districts_id }}<br>
                                </div> --}}
                            </div>
                            <div class="col-md-7 table-responsive">
                                <h4>Detail Harga</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Foto</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" width="50px" alt="Product Image">
                                                </td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Rp {{ number_format($item->price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Total Harga: <span class="float-end">Rp {{ number_format($orders->total_price) }}</span></h4>
                                <h6 class="px-2">Status Pembayaran: <span class="float-end">{{ $orders->status }}</span></h6>
                                <h6 class="px-2">Status Pesanan: <span class="float-end">{{ $orders->status_pesanan }}</span></h6>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
