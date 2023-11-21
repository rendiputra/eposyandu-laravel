@extends('layouts.admin')

@section('title')
  Riwayat Pemeriksaan Lansia
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}"> --}}
@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Lansia</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Lansia</li>
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
          <h3 class="card-title">Daftar Lansia Di Keluarga</h3>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>Umur</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($empty))
                  @foreach ($data as $d)
                  <tr>
                    <td >{{ $d->nama }}</td>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->jenis_kelamin }}</td>
                    <td>{{ $d->umur }}</td>
                    <td class="text-center"> 
                      <a href="{{ route('user.riwayat_lansia', $d->id_lansia) }}" class="btn btn-primary"> <i class="fa-solid fa-file-medical"></i> Riwayat pemeriksaan </a>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="6" class="text-center">Tidak ada data</td>
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
  {{-- <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script> --}}
  {{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script> --}}
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  {{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script> --}}
  {{-- <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script> --}}

  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        order: [[0, 'desc']],
        // "buttons": ["excel", "pdf", "print"]
        "buttons": [
          // {
          //   extend: "excel",
          //   exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5, 6]
          //   }}, 
          // {
          //   extend: "pdf",
          //   exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5, 6]
          //   }
          // }, 
          {
            extend: "print",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
          }
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        order: [[0, 'desc']],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        // "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

@endsection