@extends('layouts.admin')

@section('title')
    Tambah Data Balita
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Data Balita</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('kader.list_balita') }}">Balita</a></li>
          <li class="breadcrumb-item active">Tambah Data Balita</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Balita</h3>
        </div>
      
        <form action="{{ route('kader.tambah_balita_act') }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nama">Nama Balita</label>
              <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                id="nama"
                placeholder="Nama Balita ..."
                value="{{ old('nama') }}"
                required
              />
              @error('nama') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input
                name="nik"
                class="form-control @error('nik') is-invalid @enderror"
                id="nik"
                placeholder="NIK Balita ..."
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
              <label for="no_kk">No Kartu Keluarga</label>
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
              <label for="nik_ibu">NIK Ibu</label>
              <input
                name="nik_ibu"
                class="form-control @error('nik_ibu') is-invalid @enderror"
                id="nik_ibu"
                placeholder="NIK Ibu ..."
                value="{{ old('nik_ibu') }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('nik_ibu') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nama_ibu">Nama Ibu</label>
              <input
                type="text"
                name="nama_ibu"
                class="form-control @error('nama_ibu') is-invalid @enderror"
                id="nama_ibu"
                placeholder="Nama Ibu ..."
                value="{{ old('nama_ibu') }}"
                required
              />
              @error('nama_ibu') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nik_ayah">NIK Ayah</label>
              <input
                name="nik_ayah"
                class="form-control @error('nik_ayah') is-invalid @enderror"
                id="nik_ayah"
                placeholder="NIK Ayah ..."
                value="{{ old('nik_ayah') }}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                required
              />
              @error('nik_ayah') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nama_ayah">Nama Ayah</label>
              <input
                type="text"
                name="nama_ayah"
                class="form-control @error('nama_ayah') is-invalid @enderror"
                id="nama_ayah"
                placeholder="Nama Ayah ..."
                value="{{ old('nama_ayah') }}"
                required
              />
              @error('nama_ayah') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="tanggal_lahir">Tanggal lahir</label>
              <input
                type="date"
                name="tanggal_lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                id="tanggal_lahir"
                style="width: 150px"
                value="@if (Session::get('tanggal_lahir')){{ old('tanggal_lahir') }}@else{{ date('Y-m-d') }}@endif"
                required
              />
              @error('tanggal_lahir') <label class="text-danger">{{ $message }}</label> @enderror
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
              <label for="berat_badan_lahir">Berat badan saat lahir</label>
              <input
                type="number"
                name="berat_badan_lahir"
                class="form-control @error('berat_badan_lahir') is-invalid @enderror"
                id="berat_badan_lahir"
                placeholder="Berat badan saat lahir ..."
                value="{{ old('berat_badan_lahir') }}"
                min="0"
                step="0.01"
                required
              />
              @error('berat_badan_lahir') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="tinggi_badan_lahir">Tinggi badan saat lahir</label>
              <input
                type="number"
                name="tinggi_badan_lahir"
                class="form-control @error('tinggi_badan_lahir') is-invalid @enderror"
                id="tinggi_badan_lahir"
                placeholder="Tinggi badan saat lahir ..."
                value="{{ old('tinggi_badan_lahir') }}"
                min="0"
                step="0.01"
                required
              />
              @error('tinggi_badan_lahir') <label class="text-danger">{{ $message }}</label> @enderror
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
