@extends('layouts.admin')

@section('title')
    Tambah Data Akun
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Data Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_akun') }}">Akun</a></li>
          <li class="breadcrumb-item active">Tambah Data Akun</li>
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
      
        <form action="{{ route('admin.tambah_akun_act') }}" enctype="multipart/form-data" method="POST">
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
                value="{{ old('nama') }}"
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
                value="{{ old('nik') }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('nik') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="password">Password Akun</label>
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
            <div class="form-group">
              <label for="no_kk">No Kartu Keluarga Pengguna</label>
              <input
                name="no_kk"
                class="form-control @error('no_kk') is-invalid @enderror"
                id="no_kk"
                placeholder="No Kartu Keluarga ..."
                value="{{ old('no_kk') }}"
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
                value="{{ old('no_telepon') }}"
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
                  >{{ old('alamat') }}</textarea>
                  @error('alamat') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Jenis Kelamin</label>
              <select 
                name="jenis_kelamin" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('jenis_kelamin') is-invalid @enderror" 
                required>
                <option value="Laki-laki" @if (old('jenis_kelamin') == "Laki-laki" ) selected @endif>Laki-laki</option>
                <option value="Perempuan" @if (old('jenis_kelamin') == "Perempuan" ) selected @endif>Perempuan</option>
              </select>
              @error('jenis_kelamin') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Hak akses(Role)</label>
              <select 
                name="role" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('role') is-invalid @enderror" 
                required>
                <option value="1" @if (old('role') == "1" ) selected @endif>Pengguna</option>
                <option value="2" @if (old('role') == "2" ) selected @endif>Kader</option>
                <option value="3" @if (old('role') == "3" ) selected @endif>Kades</option>
                <option value="4" @if (old('role') == "4" ) selected @endif>Admin</option>
              </select>
              @error('role') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Posyandu Pengguna</label>
              <select 
                name="posyandu" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('posyandu') is-invalid @enderror" 
                required>
                @foreach ($posyandu as $p)
                  <option value="{{ $p->id_posyandu }}" @if (Session::get('posyandu') == $p->id_posyandu ) selected @endif>{{ $p->nama }}</option>  
                @endforeach
              </select>
              @error('posyandu') <label class="text-danger">{{ $message }}</label> @enderror
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
