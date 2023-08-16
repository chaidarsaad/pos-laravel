@extends('layouts.front')

@section('title')
    Cek Ongkos Kirim
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">List Ongkos Kirim Berdasarkan Kecamatan</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($district as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
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

@push('addon-script')
<script>
    let table = new DataTable('#myTable');
</script>
@endpush
