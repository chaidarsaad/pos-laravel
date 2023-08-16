@extends('layouts.admin')

@section('title')
    Stok Bahan
@endsection

@section('content')

<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Stok Bahan</h2>
        <p class="dashboard-subtitle">
            Buat Stok Bahan
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <a href="{{  url('stokbahan') }}" class="btn btn-primary mb-3">
                            Kembali
                        </a>
                        <button id="addform" type="button" value="'Tambah Form" class="btn btn-success mb-3">
                            +
                        </button>
                        <button id="removeform" type="button" value="'Hapus Form" class="btn btn-success mb-3">
                            -
                        </button>
                        <form action="{{ url('insert-stokbahan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Stok</label>
                                        <input required type="text" name="name[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Netto</label>
                                        <input required type="number" name="netto[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div id="tambah_inputan">
                                {{-- nambah disini --}}
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
                                        Simpan
                                    </button>
                                </div>
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
        let counter = 1

        $('#addform').click(function() {
            counter++

            let newForm = `<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Stok</label>
                                        <input required type="text" name="name[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Netto</label>
                                        <input required type="number" name="netto[]" class="form-control">
                                    </div>
                                </div>
                            </div>`
            $('#tambah_inputan').append(newForm)
        });

        $('#removeform').click(function() {
            if (counter == 1) {
                console.log('tidak bisa dihapus');
            }

            $('#tambah_inputan').remove()
            counter--
        });
    </script>
@endpush