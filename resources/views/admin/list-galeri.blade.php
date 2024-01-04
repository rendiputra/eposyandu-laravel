@extends('layouts.admin')

@section('title')
    Galeri Foto
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}"> --}}
  
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Galeri</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Galeri Foto</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    {{-- <div class="card card-default color-palette-box"> --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Galeri</h3>
        </div>
      
        <div class="card-body">
          <a href="{{ route('admin.tambah_galeri') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-pen-to-square"></i> Upload Galeri Foto</a>
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Gambar</th>
                  <th>Dibuat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($empty))
                  @foreach ($data as $d)
                  <tr>
                    <td>{{ $d->title }}</td>
                    <td class="text-center"><img src="{{ url(asset('image')) }}/{{ $d->image }}" alt="{{ $d->title }}" height="100px" >  </td>
                    <td>{{ $d->created_at }}</td>
                    <td class="text-center"> 
                      <a href="{{ route('admin.update_galeri', $d->id_galeri) }}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> Ubah </a> 
                      <a type="submit" class="mt-2 btn btn-danger" onclick="if (confirm('Apakah anda yakin menghapus galeri {{ $d->title }}?')) { 
                        event.preventDefault();
                        document.getElementById('delete-data{{ $d->id_galeri }}').submit(); 
                      }"> <i class="fa-solid fa-trash-can"></i> Hapus </a> 
                      <form id="delete-data{{ $d->id_galeri }}" action="{{ route('admin.delete_galeri', $d->id_galeri) }}" method="POST" style="display: none;">
                        @csrf
                      </form> 
                    </td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="5" class="text-center">Tidak ada data</td>
                @endif
              </tbody>
              {{-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                </tr>
              </tfoot> --}}
            </table>
          </div>
        </div>
      </div>
  </div>
</section>
@endsection

@section('js')

  {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        order: [[2, 'desc']],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    @if (session('sukses'))
      $('.toastrDefaultSuccess').ready(function() {
        toastr.success('{{ session("sukses") }}')
      });
    @endif
  </script>
@endsection