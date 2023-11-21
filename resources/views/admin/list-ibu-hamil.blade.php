@extends('layouts.admin')

@section('title')
    Data Ibu Hamil
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ibu Hamil</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar data ibu hamil</li>
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
          <h3 class="card-title">Data ibu hamil yang ada di desa Grujugan</h3>
        </div>
      
        <div class="card-body">
          <a href="{{ route('admin.tambah_ibu_hamil') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-pen-to-square"></i> Tambah data</a>
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>No KK</th>
                  <th>HPHT</th>
                  <th>HPL</th>
                  <th>No telepon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($empty))
                  @foreach ($data as $d)
                  <tr>
                    <td>{{ $d->nama }}</td>
                    <td >{{ $d->nik }}</td>
                    <td>{{ $d->no_kk }}</td>
                    <td>{{ $d->HPHT }}</td>
                    <td>{{ $d->HPL }}</td>
                    <td>{{ $d->no_telepon }}</td>
                    <td class="text-center"> 
                      <a href="{{ route('admin.update_ibu_hamil', $d->id_ibu_hamil) }}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> Ubah </a> 
                      <a type="submit" class="mt-2 btn btn-danger" onclick="if (confirm('Apakah anda yakin menghapus data {{ $d->nama }}?')) { 
                        event.preventDefault();
                        document.getElementById('delete-data{{ $d->id_ibu_hamil }}').submit(); 
                      }"> <i class="fa-solid fa-trash-can"></i> Hapus </a> 
                      <form id="delete-data{{ $d->id_ibu_hamil }}" action="{{ route('admin.delete_ibu_hamil', $d->id_ibu_hamil) }}" method="POST" style="display: none;">
                        @csrf
                      </form> 
                    </td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="7" class="text-center">Tidak ada data</td>
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
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        // "buttons": ["excel", "pdf", "print"]
        "buttons": [
          {
            extend: "excel",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }}, 
          {
            extend: "pdf",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
          }, 
          {
            extend: "print",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
          }
        ]
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