@extends('layouts.admin')

@section('title')
    Tulis Artikel
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tulis Artikel</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.list_artikel') }}">Artikel</a></li>
          <li class="breadcrumb-item active">Tulis Artikel</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Artikel</h3>
        </div>
      
        <form action="{{ route('admin.tambah_artikel_act') }}" enctype="multipart/form-data" method="POST">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="nama">Judul Artikel</label>
              <input
                type="text"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                placeholder="Judul Artikel ..."
                value="{{ old('title') }}"
                required
              />
              @error('title') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="nama">Gambar</label>
              <input
                type="file"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
                id="image"
                placeholder="Gambar ..."
                value="{{ old('image') }}"
                required
              />
              <img id="blah" src="{{ url(asset('asset/blank-file-svgrepo-com.svg')) }}" alt="your image" height="50px" class="mt-2 ml-3"/>
              @error('image') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
              <label for="description">Isi Artikel</label>
                <textarea 
                  name="description" 
                  class="form-control @error('description') is-invalid @enderror" 
                  id="description" 
                  rows="3" 
                  placeholder="Isi Artikel ..."
                  >{{ old('description') }}</textarea>
                  @error('description') <label class="text-danger">{{ $message }}</label> @enderror
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
  <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
  <script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'description' );

    image.onchange = evt => {
      const [file] = image.files
      if (file) {
        blah.src = URL.createObjectURL(file)
      }
    }
</script>
@endsection