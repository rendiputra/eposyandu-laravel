@extends('layouts.admin')

@section('title')
    Update Profile
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard </a></li>
          <li class="breadcrumb-item active">Update Profile</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Profile</h3>
        </div>
      
        <form action="{{ route('user.update_akun_act') }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nik">NIK</label>
              <h4>{{ $data->nik }}</h4>
            </div>
            <div class="form-group">
              <label for="no_kk">No Kartu Keluarga</label>
              <h4>{{ $data->no_kk }}</h4>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                id="nama"
                placeholder="Nama Pengguna ..."
                value="{{ $data->name }}"
                required
              />
              @error('nama') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="no_telepon">No telepon</label>
              <input
                name="no_telepon"
                class="form-control @error('no_telepon') is-invalid @enderror"
                id="no_telepon"
                placeholder="No telepon ..."
                value="{{ $data->no_telp }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "15"
                min="0"
              />
              @error('no_telepon') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
                <textarea 
                  name="alamat" 
                  class="form-control @error('alamat') is-invalid @enderror" 
                  id="alamat" 
                  rows="3" 
                  placeholder="Alamat ..."
                  >{{ $data->alamat }}</textarea>
                  @error('alamat') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Jenis Kelamin</label>
              <select 
                name="jenis_kelamin" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('jenis_kelamin') is-invalid @enderror" 
                required>
                <option value="Laki-laki" @if ($data->jenis_kelamin == "Laki-laki" ) selected @endif>Laki-laki</option>
                <option value="Perempuan" @if ($data->jenis_kelamin == "Perempuan" ) selected @endif>Perempuan</option>
              </select>
              @error('jenis_kelamin') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
</section>

<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ubah password</h3>
        </div>
      
        <form action="{{ route('user.update_password_act', $data->id) }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="password">Password Baru</label>
              <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password"
                placeholder="password Pengguna ..."
                value="{{ old('password') }}"
                required
              />
              @error('password') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="password_confirmation">Konfirmasi Password</label>
              <input
                type="password"
                name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation"
                placeholder="Konfirmasi Password Pengguna ..."
                value="{{ old('password_confirmation') }}"
                required
              />
              @error('password_confirmation') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection

@section('js')
  <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
  <script>
    @if (session('sukses'))
      $('.toastrDefaultSuccess').ready(function() {
        toastr.success('{{ session("sukses") }}')
      });
    @endif
  </script>
@endsection
