@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a>
            </h6>
        </div>
    </div>

    <div class="container mt-3">
        <form action="{{ url('midtranspayment') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- <input type="hidden" name=""> --}}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Detail Pesanan</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-12">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" required class="form-control firstname" value="{{ Auth::user()->name }}" name="fname" placeholder="Masukkan Nama">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="">No WhatsApp</label>
                                    <input type="text" required class="form-control phone" value="{{ Auth::user()->phone }}" name="phone" placeholder="Masukkan No WhatsApp dengan awalan +62">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Metode Pengambilan Kue</label>
                                    <select name="status_pickup" class="form-control" required placeholder="pilih metode">
                                        <option value="ambil kue di toko">ambil kue di toko</option>
                                        <option value="kue diantar ke alamat tujuan">kue diantar ke alamat tujuan</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Catatan Pesanan</label>
                                    <input type="text" class="form-control message" name="message" placeholder="">
                                    <span id="message_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <h6>Kosongkan data dibawah ini jika ambil kue di toko</h6>
                                    <label for="">Kecamatan</label>
                                    <select name="districts_id" class="form-control">
                                        <option value="{{ $userd->districts_id }}">Pilih Kecamatan</option>
                                          @foreach ($district as $item)
                                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                                          @endforeach
                                      </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Alamat Lengkap</label>
                                    <input type="text" class="form-control address1" value="" name="address1" placeholder="Masukkan alamat lengkap">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <h6 style="text-align: justify" class="my-2">NB : Ongkos kirim dibayar saat kurir tiba di lokasi. Klik <a style="text-decoration: none" href="{{ url('cek-ongkir') }}">disini</a> untuk melihat ongkos kirim.</h6>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Detail Pembayaran</h6>
                            <hr>
                            @php $total = 0; @endphp
                            @if($cartitems->count() > 0)
                                <table class="table table-striped table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="w-75">Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartitems as $item)
                                        <tr>
                                            @php $total += ($item->products->price * $item->prod_qty) @endphp
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ number_format($item->products->price) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                                <h6 class="px-2">Total Harga<span class="float-end">Rp {{ number_format($total) }}</span></h6>
                                <hr>
                                <button type="submit" class="btn btn-success w-100 mb-2">Bayar Sekarang</button>
                            @else
                                <h4 class="text-center">Tidak ada produk di keranjang</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')


@endsection
