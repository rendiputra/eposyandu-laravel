@extends('layouts.admin')

@section('title')
    Update Data Ibu Hamil
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Data Ibu Hamil</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_ibu_hamil') }}">Ibu Hamil</a></li>
          <li class="breadcrumb-item active">Update Data Ibu Hamil</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ibu Hamil</h3>
        </div>
      
        <form action="{{ route('admin.update_ibu_hamil_act', $data->id_ibu_hamil) }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nama">Nama Ibu Hamil</label>
              <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                id="nama"
                placeholder="Nama Ibu Hamil ..."
                value="{{ $data->nama }}"
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
                placeholder="NIK Ibu Hamil ..."
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                value="{{ $data->nik }}"
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
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "16"
                min="0"
                value="{{ $data->no_kk }}"
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
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number"
                maxlength = "15"
                min="0"
                value="{{ $data->no_telepon }}"
                required
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
                  required>{{ $data->alamat }}</textarea>
                  @error('alamat') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nama_ayah">Nama ayah</label>
              <input
                type="text"
                name="nama_ayah"
                class="form-control @error('nama_ayah') is-invalid @enderror"
                id="nama_ayah"
                placeholder="Nama ayah ..."
                value="{{ $data->nama_ayah }}"
                required
              />
              @error('nama_ayah') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nama_ibu">Nama ibu</label>
              <input
                type="text"
                name="nama_ibu"
                class="form-control @error('nama_ibu') is-invalid @enderror"
                id="nama_ibu"
                placeholder="Nama ibu ..."
                value="{{ $data->nama_ibu }}"
                required
              />
              @error('nama_ibu') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="exampleSelectRounded0">Posyandu</label>
              <select 
                name="posyandu" 
                id="exampleSelectRounded0" 
                class="custom-select rounded-0 @error('posyandu') is-invalid @enderror" 
                required>
                @foreach ($posyandu as $p)
                  <option value="{{ $p->id_posyandu }}" @if ($data->id_posyandu == $p->id_posyandu ) selected @endif>{{ $p->nama }}</option>  
                @endforeach
              </select>
              @error('posyandu') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="hpht">Hari Pertama Haid Terakhir</label>
              <input
                type="date"
                name="hpht"
                class="form-control @error('hpht') is-invalid @enderror"
                id="hpht"
                style="width: 150px"
                value="{{ $data->HPHT }}"
                required
              />
              @error('hpht') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="hpht">Hari Perkiraan Lahir</label>
              <input
                type="date"
                name="hpl"
                class="form-control @error('hpl') is-invalid @enderror"
                id="hpl"
                style="width: 150px"
                value="{{ $data->HPL }}"
                required
              />
              @error('hpl') <label class="text-danger">{{ $message }}</label> @enderror
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
