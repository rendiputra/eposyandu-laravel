@extends('layouts.admin')

@section('title')
  Dashboard Admin
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
        <h1>Dashboard Admin</h1>
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
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $dataJumlahBalitaStuntingPerBulanIni->total_balita }}</h3>
            <p>Total Balita Stunting</p>
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
              <h3 class="card-title">Grafik Jumlah Pemeriksaan Perbulan (12 bulan terakhir)</h3>
              <a href="{{ route('kader.list_pemeriksaan_balita') }}">Lihat data</a>
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
              <h3 class="card-title">Grafik Balita (Berdasarkan jenis kelamin)</h3>
              <a href="{{ route('kader.list_balita') }}">Lihat data</a>
            </div>
          </div>
          <div class="card-body">
            <div class="position-relative mb-4">
              <canvas id="grafikBalitaJk" height="100"></canvas>
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

  const dataPemeriksaanBulanan = {
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
      }
    ]
  };

  // const config = {
  //   type: 'bar',
  //   data: data,
  //   options: {}
  // };
  const configPemeriksaanBulanan = {
    type: 'bar',
    data: dataPemeriksaanBulanan,
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
    configPemeriksaanBulanan
  );

  const dataGrafikBalitaJk = {
    labels: ['Laki-laki', 'Perempuan'],
    datasets: [
      {
        label: 'Balita',
        data: [{{ $dataJumlahBalitaLaki[0]->jumlah }}, {{ $dataJumlahBalitaPerempuan[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)', 'rgb(255, 193, 7)'],
      }
    ]
  };

  const configGrafikBalitaJk = {
    type: 'pie',
    data: dataGrafikBalitaJk,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Balita (Berdasarkan kelamin)'
        }
      }
    },
  };

  const grafikBalitaJk = new Chart(
    document.getElementById('grafikBalitaJk'),
    configGrafikBalitaJk
  );
</script>
@endsection
