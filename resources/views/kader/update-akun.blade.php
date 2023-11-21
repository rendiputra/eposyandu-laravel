@extends('layouts.admin')

@section('title')
    Update Data Akun
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Data Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('kader.list_akun') }}">Akun</a></li>
          <li class="breadcrumb-item active">Update Data Akun</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Akun</h3>
        </div>
      
        <form action="{{ route('kader.update_akun_act', $data->id) }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nama">Nama Pengguna</label>
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
              <label for="nik">NIK Pengguna</label>
              <input
                name="nik"
                class="form-control @error('nik') is-invalid @enderror"
                id="nik"
                placeholder="NIK Pengguna ..."
                value="{{ $data->nik }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('nik') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="no_kk">No Kartu Keluarga Pengguna</label>
              <input
                name="no_kk"
                class="form-control @error('no_kk') is-invalid @enderror"
                id="no_kk"
                placeholder="No Kartu Keluarga ..."
                value="{{ $data->no_kk }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('no_kk') <label class="text-danger">{{ $message }}</label> @enderror
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
            @if ($data->role == "1" || $data->role == "2")
            <div class="form-group">
              <label for="exampleSelectRounded0">Hak akses(Role)</label>
              <select 
                name="role" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('role') is-invalid @enderror" 
                required>
                <option value="1" @if ($data->role == "1" ) selected @endif>Pengguna</option>
                <option value="2" @if ($data->role == "2" ) selected @endif>Kader</option>
              </select>
              @error('role') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            @endif
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
</section>

@if ($data->role == "1" || $data->role == "2")
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ubah password</h3>
        </div>
      
        <form action="{{ route('kader.update_password_act', $data->id) }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="password">Password Baru</label>
              <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password"
                placeholder="password Baru ..."
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
@endif

@endsection
