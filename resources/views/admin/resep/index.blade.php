@extends('layouts.admin')

@section('title')
    Bahan Baku
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Bahan Baku</h2>
                <p class="dashboard-subtitle">
                    List Bahan Baku
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('add-resep') }}" class="btn btn-primary mb-3">
                                    + Bahan Baku
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th class="">Netto</th>
                                                <th class="">Bahan Baku</th>
                                                <th class="">Produk</th>
                                                <th class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
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
            columns: [{
                    data: 'netto',
                    name: 'netto'
                },
                {
                    data: 'stokbahan.name',
                    name: 'stokbahan.name'
                },
                {
                    data: 'product.name',
                    name: 'product.name'
                },
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
@endpush
