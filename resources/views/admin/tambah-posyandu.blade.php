@extends('layouts.admin')

@section('title')
    Tambah Data Posyandu
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Data Posyandu</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_posyandu') }}">Posyandu</a></li>
          <li class="breadcrumb-item active">Tambah Data Posyandu</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Posyandu</h3>
        </div>
      
        <form action="{{ route('admin.tambah_posyandu_act') }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="exampleInput1">Nama Posyandu</label>
              <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                id="exampleInput1"
                placeholder="Nama Posyandu "
                value="{{ old('nama') }}"
                required
              />
              @error('nama') <label class="text-danger">Jenis Posyandu</label> @enderror
            </div>
            {{-- <div class="form-group">
              <label for="exampleSelectRounded0">Jenis Posyandu</label>
              <select 
                name="jenis_posyandu" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('jenis_posyandu') is-invalid @enderror" 
                required>
                <option value="balita" @if (old('jenis_posyandu') == "balita" ) selected @endif>Balita</option>
                <option value="lansia" @if (old('jenis_posyandu') == "lansia" ) selected @endif>Lansia</option>
              </select>
              @error('jenis_posyandu') <label class="text-danger">{{ $message }}</label> @enderror
            </div> --}}
            <div class="form-group">
              <label for="exampleInput2">Alamat</label>
                <textarea 
                  name="alamat" 
                  class="form-control @error('alamat') is-invalid @enderror" 
                  id="exampleInput2" 
                  rows="3" 
                  placeholder="Alamat ..."
                  required>{{ old('alamat') }}</textarea>
                  @error('alamat') <label class="text-danger">{{ $message }}</label> @enderror
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
