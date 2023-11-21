@extends('layouts.admin')

@section('title')
    Tambah Data Pemeriksaan Balita
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Data Pemeriksaan Balita</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('kader.list_pemeriksaan_balita') }}">List Pemeriksaan Balita</a></li>
          <li class="breadcrumb-item active">Tambah Data Pemeriksaan Balita</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pemeriksaan Balita</h3>
        </div>
      
        <form action="{{ route('kader.periksa_balita_act') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <input type="hidden" name="id_balita" value="{{ $data->id_balita }}"/>
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Balita</label>
              <h4>{{ $data->nama }}</h4>
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <h4>{{ $data->nik }}</h4>
            </div>
            <div class="form-group">
              <label for="tanggal_periksa">Tanggal Periksa</label>
              <input
                type="date"
                name="tanggal_periksa"
                class="form-control @error('tanggal_periksa') is-invalid @enderror"
                id="tanggal_periksa"
                style="width: 150px"
                value="@if (Session::get('tanggal_periksa')){{ old('tanggal_periksa') }}@else{{ date('Y-m-d') }}@endif"
                required
              />
              @error('tanggal_periksa') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="berat_badan">Berat badan</label>
              <input
                type="number"
                name="berat_badan"
                class="form-control @error('berat_badan') is-invalid @enderror"
                id="berat_badan"
                placeholder="Berat badan ..."
                value="{{ old('berat_badan') }}"
                min="0"
                step="0.01"
                required
              />
              @error('berat_badan') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="tinggi_badan">Tinggi/Panjang Badan</label>
              <input
                type="number"
                name="tinggi_badan"
                class="form-control @error('tinggi_badan') is-invalid @enderror"
                id="tinggi_badan"
                placeholder="Tinggi badan ..."
                value="{{ old('tinggi_badan') }}"
                min="0"
                step="0.01"
                required
              />
              @error('tinggi_badan') <label class="text-danger">{{ $message }}</label> @enderror
              <label class="text-secondary">Keterangan: *Pengukuran panjang badan dilakukan dalam keadaan anak
                telentang</label>
            </div>
            <div class="form-group">
              <label for="lingkar_lengan_atas">Lingkar lengan atas</label>
              <input
                type="number"
                name="lingkar_lengan_atas"
                class="form-control @error('lingkar_lengan_atas') is-invalid @enderror"
                id="lingkar_lengan_atas"
                placeholder="Lingkar lengan atas ..."
                value="{{ old('lingkar_lengan_atas') }}"
                min="0"
                step="0.01"
                required
              />
              @error('lingkar_lengan_atas') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="lingkar_kepala">Lingkar kepala</label>
              <input
                type="number"
                name="lingkar_kepala"
                class="form-control @error('lingkar_kepala') is-invalid @enderror"
                id="lingkar_kepala"
                placeholder="Lingkar lengan atas ..."
                value="{{ old('lingkar_kepala') }}"
                min="0"
                step="0.01"
                required
              />
              @error('lingkar_kepala') <label class="text-danger">{{ $message }}</label> @enderror
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
