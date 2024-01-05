@extends('layouts.admin')

@section('title')
    Ubah Data Vaksin
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ubah Data Vaksin</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_vaksin') }}">Vaksin</a></li>
          <li class="breadcrumb-item active">Ubah Data Vaksin</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Vaksin</h3>
        </div>
      
        <form action="{{ route('admin.update_vaksin_act', $data->id_vaksin) }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="exampleInput1">Nama vaksin</label>
              <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                id="exampleInput1"
                placeholder="Nama vaksin "
                value="{{ $data->nama }}"
                required
              />
              @error('nama') <label class="text-danger">{{ $message }}</label> @enderror
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
