@extends('layouts.karyawan')

@section('title')
    Product
@endsection

@section('content')

    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">
                    Edit "{{ $products->name }}" Product
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ url('update-productkar/' . $products->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ url('productskar') }}" class="btn btn-primary mb-3">
                                        Kembali
                                    </a>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Product</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $products->name }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Foto Product</label>
                                                <input type="file" name="image" class="form-control" multiple
                                                    accept="image/*" />
                                                <small>Kosongkan jika tidak ingin mengganti foto product</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Harga Product</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $products->price }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <input type="number" name="qty" class="form-control"
                                                    value="{{ $products->qty }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Tampilkan Produk?</label>
                                            <input type="checkbox" {{ $products->status == '1' ? 'checked' : '' }}
                                                name="status">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Trending</label>
                                            <input type="checkbox" {{ $products->trending == '1' ? 'checked' : '' }}
                                                name="trending">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Deskripsi Product</label>
                                                <textarea name="small_description" id="editor">{!! $products->small_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
