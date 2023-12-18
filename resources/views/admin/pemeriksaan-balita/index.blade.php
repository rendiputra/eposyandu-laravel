@extends('layouts.admin')

@section('title')
    Data Pemeriksaan Balita
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
        <h1>Pemeriksaan balita</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
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
          <h3 class="card-title">Daftar data pemeriksaan balita</b></h3>
        </div>
        
        <div class="card-body">
            <form action="{{ route('kader.periksa_balita') }}" method="get">
              @csrf
              <div class="form-group">
                <label>Pilih nama balita yang ingin diinput</label>
                <select class="form-control select2" style="height: 120%; width: 300px" name="id_balita">
                  @foreach ($balita as $b)
                    <option value="{{ $b->id_balita }}">{{ $b->nama }} - {{ $b->nama_orangtua }} ({{ $b->nama_posyandu }})</option>
                  @endforeach
                </select>
              </div>
              <button class="btn btn-primary mb-3" type="submit"><i class="fa-solid fa-pen-to-square"></i> Tambah data pemeriksaan</button>
            </form>
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Posyandu</th>
                  <th>Berat Badan</th>
                  <th>Panjang Badan</th>
                  <th>Lingkar lengan</th>
                  <th>Lingkar kepala</th>
                  <th>Status Stunting</th>
                  <th>Status Berat Badan</th>
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
                    <td>{{ $d->nama_posyandu }}</td>
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
                      <a href="{{ route('admin.detail_pemeriksaan_balita', $d->id_pemeriksaan_balita) }}" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail </a> 
                      <a href="{{ route('kader.update_pemeriksaan_balita', $d->id_pemeriksaan_balita) }}" class="mt-2 btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> Ubah </a> 
                      <a type="submit" class="mt-2 btn btn-danger" onclick="if (confirm('Apakah anda yakin menghapus data {{ $d->nama }}?')) { 
                        event.preventDefault();
                        document.getElementById('delete-data{{ $d->id_pemeriksaan_balita }}').submit(); 
                      }"> <i class="fa-solid fa-trash-can"></i> Hapus </a> 
                      <form id="delete-data{{ $d->id_pemeriksaan_balita }}" action="{{ route('kader.delete_pemeriksaan_balita', $d->id_pemeriksaan_balita) }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="9" class="text-center">Tidak ada data</td>
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
            }}, 
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
        "searching": true,
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