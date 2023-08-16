@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Pesanan</h2>
            <p class="dashboard-subtitle">
                Detail Transaksi "{{ $orders->tracking_no }}""
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{  url('orders') }}" class="btn btn-primary mb-3">
                                Kembali
                            </a>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Detail Pesanan</h4>
                                <hr>
                                <label for="">Nama Lengkap</label>
                                <div class="border p-2 mt-0">{{ $orders->fname }}</div>
                                <label for="">No WhatsApp</label>
                                <div class="border"><a style="text-decoration: none" href="https://wa.me/{{ $orders->phone }}?text=Halo,%20{{ $orders->fname }}%0aPesanan%20dengan%20nomor%20:%20*{{ $orders->tracking_no }}*%0aStatus%20Pesanan%20:%20*{{ $orders->status_pesanan }}*">{{ $orders->phone }}</a></div>
                                <label for="">Metode Pengambilan Kue</label>
                                <div class="border p-2 mt-0">
                                    {{ $orders->status_pickup }}
                                </div>
                                <label for="">Catatan Pesanan</label>
                                <div class="border p-2 mt-0">
                                    {{ $orders->message }}
                                </div>
                                <label for="">Kecamatan</label>
                                <div class="border p-2 mt-0">
                                    {{-- {{ App\Models\District::find($orders->orders->user->districts_id)->name }} --}}
                                </div>
                                <label for="">Alamat Lengkap</label>
                                <div class="border p-2 mt-0">
                                    {{ $orders->address1 }}
                                </div>
                            </div>
                            <div class="col-md-6 table-responsive">
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
                                <h4>Total Harga : <span class="float-end">Rp {{ number_format($orders->total_price) }}</span></h4>
                                <h6>Status Pembayaran : <span class="float-end">{{ ($orders->status) }}</span></h6>
                                <label for="">Status Pesanan</label>
                                <form action="{{ url('update-order/'.$orders->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-select" name="status_pesanan">
                                        <option selected>{{ $orders->status_pesanan }}</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Pesanan telah siap, silahkan ambil di toko">Pesanan telah siap, silahkan ambil di toko</option>
                                        <option value="Pesanan telah siap dan sedang diantarkan ke alamat tujuan">Pesanan telah siap dan sedang diantarkan ke alamat tujuan</option>
                                    </select>
                                    <button type="submit" class="btn btn-success float-end mt-3">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
