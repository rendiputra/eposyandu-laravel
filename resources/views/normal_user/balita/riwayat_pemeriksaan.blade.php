@extends('layouts.admin')

@section('title')
    Data Riwayat Pemeriksaan Balita
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
        <h1>Riwayat Pemeriksaan Balita</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar data pemeriksaan balita</li>
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
          <h3 class="card-title">Daftar riwayat pemeriksaan balita</h3>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Berat</th>
                  <th>Tinggi</th>
                  <th>Lingkar lengan</th>
                  <th>Lingkar kepala</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($empty))
                  @foreach ($data as $d)
                  <tr>
                    @php
                      $date=date_create($d->created_at);
                      $date = date_format($date,"Y/m/d");
                    @endphp
                    <td>{{ $date }}</td>
                    <td >{{ $d->nama }}</td>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->berat_badan }}</td>
                    <td>{{ $d->tinggi_badan }}</td>
                    <td>{{ $d->lingkar_lengan_atas }}</td>
                    <td>{{ $d->lingkar_kepala }}</td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="8" class="text-center">Tidak ada data</td>
                @endif
              </tbody>
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
  <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

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