@extends('layouts.admin')

@section('title')
    Detail Pemeriksaan Balita
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detail Pemeriksaan balita</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">List Pemeriksaan Balita</a></li>
          <li class="breadcrumb-item active">Detail pemeriksaan balita</li>
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
          <h3 class="card-title">Detail pemeriksaan balita</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <th>Nama Balita</th>
                    <td>{{ $data->nama }}</td>
                  </tr>
                  <tr>
                    <th>Umur</th>
                    <td>{{ $umur_bulan }} Bulan</td>
                  </tr>
                  <tr>
                    <th>NIK</th>
                    <td>{{ $data->nik }}</td>
                  </tr>
                  <tr>
                    <th>Nama orang tua</th>
                    <td>{{ $data->nama_orangtua }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal pemeriksaan</th>
                    @php
                        $date=date_create($data->tanggal_periksa);
                    @endphp
                    <td>{{ date_format($date,"d F Y"); }}</td>
                  </tr>
                  <tr>
                    <th>Berat badan</th>
                    <td>{{ $data->berat_badan }} kg</td>
                  </tr>
                  <tr>
                    <th>Tinggi badan</th>
                    <td>{{ $data->tinggi_badan }} cm</td>
                  </tr>
                  <tr>
                    <th>Lingkar lengan atas</th>
                    <td>{{ $data->lingkar_lengan_atas }} cm</td>
                  </tr>
                  <tr>
                    <th>Lingkar kepala</th>
                    <td>{{ $data->lingkar_kepala }} cm</td>
                  </tr>
                  <tr>
                    <th>Status Stunting</th>
                    <td>
                      @if($data->status_stunting == "severely stunted")
                      <span class="badge bg-danger">{{ $data->status_stunting }}</span>
                      @elseif($data->status_stunting == "stunted")
                      <span class="badge bg-warning">{{ $data->status_stunting }}</span>
                      @elseif($data->status_stunting == "normal")
                      <span class="badge bg-success">{{ $data->status_stunting }}</span>
                      @elseif($data->status_stunting == "tinggi")
                      <span class="badge bg-secondary">{{ $data->status_stunting }}</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Status berat badan</th>
                    <td>
                      @if($data->status_berat_badan == "severely underweight")
                        <span class="badge bg-danger">{{ $data->status_berat_badan }}</span>
                      @elseif($data->status_berat_badan == "underweight")
                        <span class="badge bg-warning">{{ $data->status_berat_badan }}</span>
                      @elseif($data->status_berat_badan == "normal")
                        <span class="badge bg-success">{{ $data->status_berat_badan }}</span>
                      @elseif($data->status_berat_badan == "overweight")
                        <span class="badge bg-danger">{{ $data->status_berat_badan }}</span>
                      @endif
                    </td>
                  </tr>
                </tbody>
                {{-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <td>Browser</td>
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

  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, 
        "lengthChange": false, 
        "autoWidth": false, 
        "ordering": false, 
        "paging": false,
        "searching": false,
        order: [[0, 'desc']],
        // "buttons": ["excel", "pdf", "print"]
        "buttons": [
          {
            extend: "pdf",
            exportOptions: {
                columns: [0, 1]
            }
          }, 
          {
            extend: "print",
            exportOptions: {
                columns: [0, 1]
            }
          }
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        order: [[0, 'desc']],
        "paging": false,
        "lengthChange": false,
        "searching": false,
        // "ordering": true,
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

    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    </script>

@endsection