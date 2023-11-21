@extends('layouts.admin')

@section('title')
  Dashboard Kades
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
        <h1>Dashboard Kades</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $dataJumlahPosyandu[0]->jumlah }}</h3>
            <p>Total Posyandu</p>
          </div>
          <div class="icon">
            <i class="ion ion-home"></i>
          </div>
        </div>
      </div>
    
      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $dataJumlahBalita[0]->jumlah }}</h3>
            <p>Total Balita</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
    
      <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $dataJumlahLansia[0]->jumlah }}</h3>
            <p>Total Lansia</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
    
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
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Jumlah Pemeriksaan Perbulan</h3>
            </div>
          </div>
          <div class="card-body">
      
            <div class="position-relative mb-4">
              <canvas id="pemeriksaanBalitaChart" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Balita dan Lansia</h3>
            </div>
          </div>
          <div class="card-body">
      
            <div class="position-relative mb-4">
              <canvas id="pieChart" height="100"></canvas>
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
  const labels = [
    @foreach ($dataPemeriksaanBalita as $d)
      @php
        $date = date_create("$d->created_at");
        $date = date_format($date,"F");
      @endphp
      '{{ $date }}',
    @endforeach
  ];

  const data = {
    labels: labels,
    datasets: [
      {
      label: 'Balita',
      backgroundColor: 'rgb(40, 167, 69)',
      borderColor: 'rgb(40, 167, 69)',
      data: [
        @foreach ($dataPemeriksaanBalita as $d)
          {{ $d->jumlah }},
        @endforeach
        ],
      },
      {
      label: 'Lansia',
      backgroundColor: 'rgb(255, 193, 7)',
      borderColor: 'rgb(255, 193, 7)',
      data: [
        @foreach ($dataPemeriksaanLansia as $d)
          {{ $d->jumlah }},
        @endforeach
        ],
      },
    ]
  };

  // const config = {
  //   type: 'bar',
  //   data: data,
  //   options: {}
  // };
  const config = {
    type: 'bar',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Jumlah Pemeriksaan Perbulan'
        }
      }
    },
  };

  const myChart = new Chart(
    document.getElementById('pemeriksaanBalitaChart'),
    config
  );
</script>


<script>

  const data2 = {
    labels: ['Balita', 'Lansia'],
    datasets: [
      {
        label: 'Dataset 1',
        data: [{{ $dataJumlahBalita[0]->jumlah }}, {{ $dataJumlahLansia[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)', 'rgb(255, 193, 7)'],
      }
    ]
  };

  const config2 = {
    type: 'pie',
    data: data2,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Balita dan Lansia'
        }
      }
    },
  };

  const pieChart = new Chart(
    document.getElementById('pieChart'),
    config2
  );
</script>
@endsection
