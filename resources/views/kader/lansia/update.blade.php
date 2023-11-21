@extends('layouts.admin')

@section('title')
    Update Data Pemeriksaan lansia
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Data Pemeriksaan lansia</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('kader.list_pemeriksaan_lansia') }}">List Pemeriksaan lansia</a></li>
          <li class="breadcrumb-item active">Update Data Pemeriksaan lansia</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pemeriksaan lansia</h3>
        </div>
      
        <form action="{{ route('kader.update_pemeriksaan_lansia_act', $data->id_pemeriksaan_lansia) }}" enctype="multipart/form-data" method="POST">
          @csrf
          <input type="hidden" name="id_lansia" value="{{ $lansia->id_lansia }}"/>
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama lansia</label>
              <h4>{{ $lansia->nama }}</h4>
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <h4>{{ $lansia->nik }}</h4>
            </div>
            <div class="form-group">
              <label for="tanggal_periksa">Tanggal Periksa</label>
              @php
                $date=date_create($data->created_at);
                $date = date_format($date,"Y-m-d");
              @endphp
              <input
                type="date"
                name="tanggal_periksa"
                class="form-control @error('tanggal_periksa') is-invalid @enderror"
                id="tanggal_periksa"
                style="width: 150px"
                value="@if (Session::get('tanggal_periksa')){{ old('tanggal_periksa') }}@else{{ $date }}@endif"
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
                value="{{ $data->berat_badan }}"
                min="0"
                step="0.01"
              />
              @error('berat_badan') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="tinggi_badan">Tinggi badan</label>
              <input
                type="number"
                name="tinggi_badan"
                class="form-control @error('tinggi_badan') is-invalid @enderror"
                id="tinggi_badan"
                placeholder="Tinggi badan ..."
                value="{{ $data->tinggi_badan }}"
                min="0"
                step="0.01"
              />
              @error('tinggi_badan') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="lingkar_perut">Lingkar perut</label>
              <input
                type="number"
                name="lingkar_perut"
                class="form-control @error('lingkar_perut') is-invalid @enderror"
                id="lingkar_perut"
                placeholder="Lingkar perut ..."
                value="{{ $data->lingkar_perut }}"
                min="0"
                step="0.01"
              />
              @error('lingkar_perut') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="gula_darah">Gula darah</label>
              <input
                type="number"
                name="gula_darah"
                class="form-control @error('gula_darah') is-invalid @enderror"
                id="gula_darah"
                placeholder="Gula darah ..."
                value="{{ $data->gula_darah }}"
                min="0"
                step="0.01"
              />
              @error('gula_darah') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="imt">Indeks massa tubuh</label>
              <input
                type="number"
                name="imt"
                class="form-control @error('imt') is-invalid @enderror"
                id="imt"
                placeholder="Indeks massa tubuh ..."
                value="{{ $data->imt }}"
                min="0"
                step="0.01"
              />
              @error('lingkar_kepala') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="tensi">Tensi</label>
              <input
                type="number"
                name="tensi"
                class="form-control @error('tensi') is-invalid @enderror"
                id="tensi"
                placeholder="Tensi ..."
                value="{{ $data->tensi }}"
                min="0"
                step="0.01"
              />
              @error('tensi') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="kolesterol">Kolesterol</label>
              <input
                type="number"
                name="kolesterol"
                class="form-control @error('kolesterol') is-invalid @enderror"
                id="kolesterol"
                placeholder="kolesterol ..."
                value="{{ $data->kolesterol }}"
                min="0"
                step="0.01"
              />
              @error('kolesterol') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="asam_urat">Asam urat</label>
              <input
                type="number"
                name="asam_urat"
                class="form-control @error('asam_urat') is-invalid @enderror"
                id="asam_urat"
                placeholder="Asam urat ..."
                value="{{ $data->asam_urat }}"
                min="0"
                step="0.01"
              />
              @error('asam_urat') <label class="text-danger">{{ $message }}</label> @enderror
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
