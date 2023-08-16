@extends('layouts.admin')

@section('title')
    Akun
@endsection

@section('content')

<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
      <h2 class="dashboard-title">Akun</h2>
      <p class="dashboard-subtitle">
          Edit "{{ $users->name }}" Akun
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
        <form action="{{ url('update-user/'.$users->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="card">
            <div class="card-body">
              <a href="{{  url('users') }}" class="btn btn-primary mb-3">
                Kembali
            </a>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" required name="name" value="{{ $users->name }}"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" required name="email" value="{{ $users->email }}"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>No WhatsApp</label>
                    <input type="text" placeholder="isi dengan awalan +62" class="form-control" name="phone" value="{{ $users->phone }}"/>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="districts_id" class="form-control">
                      <option value="{{ $users->districts_id }}" selected>{{ $users->district->name }}</option>
                        @foreach ($district as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input type="text" class="form-control" name="address1" value="{{ $users->address1 }}"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Roles</label>
                    <select name="role_as" required class="form-control">
                      <option value="{{ $users->role_as }}" selected>Tidak diganti</option>
                      <option value="0">Costumer</option>
                      <option value="1">Admin</option>
                      <option value="2">Karyawan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password"/>
                    <small>Kosongkan jika tidak ingin mengganti password</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-right">
                  <button
                    type="submit"
                    class="btn btn-success px-5"
                  >
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

