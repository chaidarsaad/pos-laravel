@extends('layouts.front')

@section('title')
    My Profile
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Profil {{ $user->name }}
                            <a href="{{ url('/') }}" class="btn btn-warning float-end">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 order-details">
                                <h4>Detail Profil
                                    <a href="{{ url('edit-profile') }}" class="btn btn-primary float-end">Edit Profile</a>
                                </h4>
                                <hr>
                                <label for="">Nama Lengkap</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                                <label for="">Email</label>
                                    <div class="border">{{ $user->email }}</div>
                                <label for="">No WhatsApp</label>
                                    <div class="border">{{ $user->phone }}</div>
                                <label for="">Kecamatan</label>
                                    <div class="border">{{ $user->district->name }}</div>
                                <label for="">Alamat Lengkap</label>
                                    <div class="border">{{ $user->address1 }}</div>

                                {{-- <div class="border">
                                    {{ $user->address1 }}<br>
                                    Kecamatan {{ $user->district->name }}<br>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
