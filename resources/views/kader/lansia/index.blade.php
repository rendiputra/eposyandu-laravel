@extends('layouts.admin')

@section('title')
    Data Pemeriksaan Lansia
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
        <h1>Pemeriksaan lansia</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar data pemeriksaan lansia</li>
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
          <h3 class="card-title">Daftar data pemeriksaan lansia</h3>
        </div>
        
        <div class="card-body">
            <form action="{{ route('kader.periksa_lansia') }}" method="get">
              @csrf
              <div class="form-group">
                <label>Pilih nama lansia yang ingin diinput</label>
                <select class="form-control select2" style="height: 100%; width: 300px" name="id_lansia" style="font-size: 0.9em">
                  @foreach ($lansia as $b)
                    <option value="{{ $b->id_lansia }}">{{ $b->nama }} - {{ $b->nik }}</option>
                  @endforeach
                </select>
              </div>
              <button class="btn btn-primary mb-3" type="submit"><i class="fa-solid fa-pen-to-square"></i> Tambah data pemeriksaan</button>
            </form>
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Berat</th>
                  <th>Tinggi</th>
                  <th>Lingkar Perut</th>
                  <th>Gula</th>
                  <th>IMT</th>
                  <th>Tensi</th>
                  <th>Kolesterol</th>
                  <th>Asam Urat</th>
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
                    <td class="text-center"> 
                      <a href="{{ route('kader.update_pemeriksaan_lansia', $d->id_pemeriksaan_lansia) }}" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> Ubah </a> 
                      <a type="submit" class="mt-2 btn btn-danger" onclick="if (confirm('Apakah anda yakin menghapus data {{ $d->nama }}?')) { 
                        event.preventDefault();
                        document.getElementById('delete-data{{ $d->id_pemeriksaan_lansia }}').submit(); 
                      }"> <i class="fa-solid fa-trash-can"></i> Hapus </a> 
                      <form id="delete-data{{ $d->id_pemeriksaan_lansia }}" action="{{ route('kader.delete_pemeriksaan_lansia', $d->id_pemeriksaan_lansia) }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </td>
                    <td>{{ $date }}</td>
                    <td >{{ $d->nama }}</td>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->berat_badan }}</td>
                    <td>{{ $d->tinggi_badan }}</td>
                    <td>{{ $d->lingkar_perut }}</td>
                    <td>{{ $d->gula_darah }}</td>
                    <td>{{ $d->imt }}</td>
                    <td>{{ $d->tensi }}</td>
                    <td>{{ $d->kolesterol }}</td>
                    <td>{{ $d->asam_urat }}</td>
                  </tr>
                  @endforeach
                @else
                  <td colspan="12" class="text-center">Tidak ada data</td>
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
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script> --}}
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
        order: [[1, 'desc']],
        // "buttons": ["excel", "pdf", "print"]
        "buttons": [
          {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7 , 8, 9, 10, 11]
            }}, 
          {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7 , 8, 9, 10, 11]
            }
          }, 
          {
            extend: "print",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7 , 8, 9, 10, 11]
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