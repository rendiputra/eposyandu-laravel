@extends('layouts.admin')

@section('title')
    Ubah Galeri Foto
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ubah Galeri Foto</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_galeri') }}">Galeri</a></li>
          <li class="breadcrumb-item active">Ubah Galeri Foto</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Galeri</h3>
        </div>
      
        <form action="{{ route('admin.update_galeri_act', $data->id_galeri) }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nama">Judul Foto</label>
              <input
                type="text"
                name="judul"
                class="form-control @error('judul') is-invalid @enderror"
                id="judul"
                placeholder="Judul galeri ..."
                value="{{ $data->judul }}"
                required
              />
              @error('title') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nama">Foto</label>
              <input
                type="file"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
                id="image"
                placeholder="Foto ..."
                value="{{ $data->image }}"
              />
              <img id="blah" src="{{ url(asset('galeri')) }}/{{ $data->image }}" height="50px" class="mt-2 ml-3"/>
              @error('image') <label class="text-danger">{{ $message }}</label> @enderror
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