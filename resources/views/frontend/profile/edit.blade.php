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
                        <h4 class="text-white">Edit Profile {{ $user->name }}
                            <a href="{{ url('my-profile') }}" class="btn btn-warning float-end">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-profile/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 order-details">
                                    <h4>Detail Profil
                                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                    </h4>
                                    <hr>
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                                    <label for="">Email</label>
                                    <input type="text" value="{{ $user->email }}" class="form-control" name="email">
                                    <label for="">Password</label>
                                    <input type="text" value="" placeholder="kosongkan password jika tidak ingin diganti" class="form-control" name="password">
                                    <label for="">No WhatsApp</label>
                                    <input type="text" value="{{ $user->phone }}" class="form-control" name="phone">
                                    <label for="">Kecamatan</label>
                                    <select name="districts_id" class="form-control">
                                        <option value="{{ $user->districts_id }}" selected>{{ $user->district->name }}</option>
                                          @foreach ($district as $item)
                                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                                          @endforeach
                                      </select>
                                    <label for="">Alamat Lengkap</label>
                                    <input type="text" value="{{ $user->address1 }}" class="form-control" name="address1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
