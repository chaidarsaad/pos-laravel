@extends('layouts.karyawan')

@section('title')
    Point Of Sales
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up" >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Point Of Sales</h2>
            <br>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <label>List Produk</label>
                            <div class="table-responsive">
                                <table id="crudTable" class="table table-hover scroll-horizontal-vertical">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <label>Barang yang dibeli</label>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-hover scroll-horizontal-vertical w-100">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th style="width: 15%">Jumlah</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalPrice = 0 @endphp
                                        @foreach($positems as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->product->price }}</td>
                                            <td>
                                                <form action="{{ url('update-pointofsalekar/'.$item->id) }}" method="post">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="input-group mb-1">
                                                            <input type="number" class="form-control" placeholder="Jumlah" name="prod_qty" value="{{ $item->prod_qty }}">
                                                            <button type="submit" class="btn btn-success" type="button">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ url('delete-pointofsalekar/'.$item->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                        @php $totalPrice += $item->product->price * $item->prod_qty @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <form action="{{ url('checkout-poskar') }}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                <div class="row">
                                    <div class="form-group">
                                        <input required placeholder="nama costumer" type="text" name="fname" class="form-control">
                                    </div>
                                    <label>Total Harga : Rp {{ number_format($totalPrice ?? 0) }}</label>
                                    <button type="submit" class="btn btn-success">
                                        Bayar
                                    </button>
                                </div>
                            </form>
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
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'price', name: 'price' },
                { data: 'qty', name: 'qty' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush