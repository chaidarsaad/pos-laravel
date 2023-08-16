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
                    Edit Bahan Baku {{ $reseps->product->name }}
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
                        <form action="{{ url('update-resep/' . $reseps->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product</label>
                                            <select name="product_id" class="form-control">
                                                <option value="{{ $reseps->product_id }}" selected>
                                                    {{ $reseps->product->name }}</option>
                                                @foreach ($product as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bahan</label>
                                            <select name="stokbahan_id" class="form-control">
                                                <option value="{{ $reseps->stokbahan_id }}" selected>
                                                    {{ $reseps->stokbahan->name }}</option>
                                                @foreach ($stokbahan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Netto</label>
                                            <input required type="number" name="netto" class="form-control"
                                                value="{{ $reseps->netto }}">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
