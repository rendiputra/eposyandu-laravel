@extends('layouts.admin')

@section('title')
  Dashboard User
@endsection

@section('css')
    
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('content')
  <!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
    
      <div class="col-lg-12 col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $dataJumlahBalita[0]->jumlah }}</h3>
            <p>Total Balita Di Keluarga</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
    
      {{-- <div class="col-lg-6 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>123</h3>
            <p>Total  Di Keluarga</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div> --}}
    
      {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>
            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Balita Di Keluarga</h3>
              <a href="{{ route('user.list_balita') }}">Lihat data</a>
            </div>
          </div>
          <div class="card-body">
      
            <div class="position-relative mb-4">
              @if (($dataJumlahBalita[0]->jumlah > 0))
              <canvas id="pieChart" height="100px" width="100px"></canvas>
              @else
                <div class="justify-content-center d-flex ">
                  <img src="{{ asset('asset/undraw_to_the_mooni.svg') }}" alt="" srcset="" width="30%">
                </div>
                <h3 class="text-center ">Tidak ada data</h3>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Tinggi Badan Balita</h3>
              <a href="{{ route('user.list_balita') }}">Lihat data</a>
            </div>
          </div>
          <div class="card-body">
      
            <div class="position-relative mb-4">
              @if (count($dataBalita) > 0)
              <canvas id="lineChart" height="100px" width="100px"></canvas>
              @else
                <div class="justify-content-center d-flex ">
                  <img src="{{ asset('asset/undraw_to_the_mooni.svg') }}" alt="" srcset="" width="30%">
                </div>
                <h3 class="text-center ">Tidak ada data</h3>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Tinggi Badan Balita</h3>
              <a href="{{ route('user.list_balita') }}">Lihat data</a>
            </div>
          </div>
          <div class="card-body">
      
            <div class="position-relative mb-4">
              @if (count($dataBalita) > 0)
              <canvas id="lineChartBerat" height="100px" width="100px"></canvas>
              @else
                <div class="justify-content-center d-flex ">
                  <img src="{{ asset('asset/undraw_to_the_mooni.svg') }}" alt="" srcset="" width="30%">
                </div>
                <h3 class="text-center ">Tidak ada data</h3>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  const data = {
    labels: ['Balita'],
    datasets: [
      {
        label: 'Dataset 1',
        data: [{{ $dataJumlahBalita[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)'],
      }
    ]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik riwayat pemeriksaan balita Di Keluarga' 
        }
      }
    },
  };

  const pieChart = new Chart(
    document.getElementById('pieChart'),
    config
  );

  const labelsTinggi = [
    @foreach ($dataBalita as $d)
      @php
        $date = date_create("$d->created_at");
        $date = date_format($date,"F");
      @endphp
      '{{ $date }}',
    @endforeach
  ];

  const dataTinggi = {
    labels: labelsTinggi,
    datasets: [
      {
        label: 'Dataset 1',
        data: [
          @foreach($dataBalita as $d)
            "{{ $d->tinggi_badan }}", 
          @endforeach
        ],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
      }
    ]
  };

  const configTinggi = {
    type: 'line',
    data: dataTinggi,
  };

  const lineChartTinggi = new Chart(
    document.getElementById('lineChart'),
    configTinggi
  );

  const labelsBerat = [
    @foreach ($dataBalita as $d)
      @php
        $date = date_create("$d->created_at");
        $date = date_format($date,"F");
      @endphp
      '{{ $date }}',
    @endforeach
  ];

  const dataBerat = {
    labels: labelsBerat,
    datasets: [
      {
        label: 'Dataset 1',
        data: [
          @foreach($dataBalita as $d)
            "{{ $d->berat_badan }}", 
          @endforeach
        ],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
      }
    ]
  };

  const configBerat = {
    type: 'line',
    data: dataBerat,
  };

  const lineChartBerat = new Chart(
    document.getElementById('lineChartBerat'),
    configBerat
  );
</script>
@endsection
