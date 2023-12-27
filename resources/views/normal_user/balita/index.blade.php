@extends('layouts.admin')

@section('title')
    Riwayat Pemeriksaan Balita
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
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
          <li class="breadcrumb-item active">Balita</li>
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
          <h3 class="card-title">Daftar riwayat pemeriksaan balita di keluarga</h3>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>Berat badan</th>
                  <th>Tinggi badan</th>
                  <th>Lingkar lengan</th>
                  <th>Lingkar kepala</th>
                  <th>Status stunting</th>
                  <th>Status berat badan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($empty))
                  @foreach ($data as $d)
                  <tr>
                    @php
                      $date = date_create($d->created_at);
                      $date = date_format($date,"Y/m/d");
                    @endphp
                    <td>{{ $date }}</td>
                    <td >{{ $d->nama }}</td>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->jenis_kelamin }}</td>
                    <td>{{ $d->berat_badan }} kg</td>
                    <td>{{ $d->tinggi_badan }} cm</td>
                    <td>{{ $d->lingkar_lengan_atas }} cm</td>
                    <td>{{ $d->lingkar_kepala }} cm</td>
                    <td>
                      @if($d->status_stunting == "severely stunted")
                        <span class="float-right badge bg-danger">{{ $d->status_stunting }}</span>
                      @elseif($d->status_stunting == "stunted")
                        <span class="float-right badge bg-warning">{{ $d->status_stunting }}</span>
                      @elseif($d->status_stunting == "normal")
                        <span class="float-right badge bg-success">{{ $d->status_stunting }}</span>
                      @elseif($d->status_stunting == "tinggi")
                        <span class="float-right badge bg-secondary">{{ $d->status_stunting }}</span>
                      @endif
                    </td>
                    <td>
                      @if($d->status_berat_badan == "severely underweight")
                        <span class="float-right badge bg-danger">{{ $d->status_berat_badan }}</span>
                      @elseif($d->status_berat_badan == "underweight")
                        <span class="float-right badge bg-warning">{{ $d->status_berat_badan }}</span>
                      @elseif($d->status_berat_badan == "normal")
                        <span class="float-right badge bg-success">{{ $d->status_berat_badan }}</span>
                      @elseif($d->status_berat_badan == "overweight")
                        <span class="float-right badge bg-danger">{{ $d->status_berat_badan }}</span>
                      @endif
                    </td>
                    <td class="text-center"> 
                      <a href="{{ route('user.detail_pemeriksaan_balita', $d->id_pemeriksaan_balita) }}" class="btn btn-primary"> <i class="fa-solid fa-circle-info"></i> Detail pemeriksaan </a>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="11" class="text-center">Tidak ada data</td>
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

  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        order: [[0, 'desc']],
        // "buttons": ["excel", "pdf", "print"]
        "buttons": [
          {
            extend: "excel",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            }
          }, 
          {
            extend: "pdf",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            }
          }, 
          {
            extend: "print",
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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