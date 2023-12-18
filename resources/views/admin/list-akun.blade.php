@extends('layouts.admin')

@section('title')
    Data akun
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
        <h1>Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar data Akun</li>
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
          <h3 class="card-title">Daftar akun pengguna</h3>
        </div>
      
        <div class="card-body">
          <a href="{{ route('admin.tambah_akun') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-pen-to-square"></i> Tambah data</a>
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>No telepon</th>
                  <th>role</th>
                  <th>Posyandu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($empty))
                  @foreach ($data as $d)
                  <tr>
                    <td>{{ $d->name }}</td>
                    <td >{{ $d->nik }}</td>
                    <td>{{ $d->no_telp }}</td>
                    <td>
                      @if ($d->role == 1)
                      Pengguna
                      @elseif ($d->role == 2)
                      Kader
                      @elseif ($d->role == 3)
                      Kepala Desa
                      @elseif ($d->role == 4)
                      Admin
                      @endif
                    </td>
                    <td>{{ $d->nama }}</td>
                    <td class="text-center"> 
                      <a href="{{ route('admin.update_akun', $d->id) }}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> Ubah </a> 
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
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
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