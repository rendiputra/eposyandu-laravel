@extends('layouts.front')
@section('title','Infografik Balita')
@section('css')
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
@endsection
@section('content')


  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="{{url('/')}}"><img class="d-inline-block me-3" src="{{asset('asset/img/icons/logo.png')}}" alt="" />E-Posyandu</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#tentang">Tentang E-Posyandu</a></li>
            <li class="nav-item"><a class="nav-link fw-bold active" href="{{ route('infografik_balita') }}">Info Grafik</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#tka">Tumbuh Kembang Anak</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('article') }}">Artikel</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#galeri">Galeri</a></li>
          @guest
            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Masuk</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Dashboard</a></li>
          @endguest
          </ul>
        </div>
      </div>
    </nav>
    <section class="content">
      <div class="container-fluid">
        <div class="row text-center justify-content-center">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Jumlah Pemeriksaan Balita Perbulan</h3>
                </div>
              </div>
              <div class="card-body">
          
                <div class="position-relative mb-4">
                  <canvas id="pemeriksaanBalitaChart" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Balita (Berdasarkan jenis kelamin)</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="pieChart5" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Usia Balita (Tahun)</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="pieChart6" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Tumbuh Kembang Balita</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col" rowspan="2">No</th>
                          <th scope="col" rowspan="2">Tumbuh kembang</th>
                          <th scope="col" colspan="2">Jumlah</th>
                          <th scope="col" rowspan="2">Total</th>
                        </tr>
                        <tr>
                          <th  scope="col">Laki-Laki</th>
                          <th scope="col">Perempuan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Stunting</td>
                          <td>{{ $dataPemeriksaanBalitaLakiTinggiTidakIdeal[0]->jumlah }}</td>
                          <td>{{ $dataPemeriksaanBalitaPerempuanTinggiTidakIdeal[0]->jumlah }}</td>
                          <td>{{ $dataPemeriksaanBalitaPerempuanTinggiTidakIdeal[0]->jumlah + $dataPemeriksaanBalitaLakiTinggiTidakIdeal[0]->jumlah }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>


    <section class="py-6 pt-7 bg-primary-gradient">
      <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot.png')}});background-position:left bottom;background-size:auto;filter:contrast(1.5);">
      </div>
      <!--/.bg-holder-->

      <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:right top;background-size:auto;margin-top:-75px;">
      </div>
      <!--/.bg-holder-->

      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-4 order-0 order-sm-0 pe-6"><a class="text-decoration-none" href="#"><img class="img-fluid me-2" src="{{asset('asset/img/icons/footer-logo.png')}}" alt="" /><span class="fw-bold fs-1 text-light">E-Posyandu</span></a>
            <p class="mt-3 text-white">Posyandu provides progressive, and affordable healthcare, accessible on mobile and online for everyone</p>
          </div>
          <div class="col-4 col-md-4 col-lg mb-3 order-2 order-sm-1">
            <h6 class="lh-lg fw-bold text-light">Kontak</h6>
            <ul class="list-unstyled mb-md-4 mb-lg-0">
              <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Tel: (021)3892749823</span></li>
              <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">WhatsApp: (0821)3989743</span></li>
            </ul>
          </div>
          <div class="col-4 col-md-4 col-lg mb-3 order-2 order-sm-1">
            <h6 class="lh-lg fw-bold text-light">Alamat</h6>
            <ul class="list-unstyled mb-md-4 mb-lg-0">
              <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Desa Grujugan, Kecamatan Petanahan, Kebumen, Jawa Tengah, Indonesia.</span></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="container pt-5">
        <div class="row">
          <div class="col-12">
            <div class="text-center">
              <p class="text-white mb-0">&copy; {{date('Y')}} All right reserved | INSTITUT TEKNOLOGI TELKOM PURWOKERTO
              </p>
            </div>
          </div>
        </div>
      </div><!-- end of .container-->

    </section>

  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> --}}



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
      label: 'Jumlah Pemeriksaan',
      backgroundColor: 'rgb(255, 193, 7)',
      borderColor: 'rgb(255, 193, 7)',
      data: [
        @foreach ($dataPemeriksaanBalita as $d)
          {{ $d->jumlah }},
        @endforeach
        ],
      },
    ]
  };

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
          text: 'Grafik Jumlah Pemeriksaan Balita Perbulan'
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
{{--  const data3 = {
    labels: ['Laki-laki', 'Perempuan'],
    datasets: [
      {
        label: 'Dataset 2',
        data: [{{ $dataJumlahBalitaLaki[0]->jumlah }}, {{ $dataJumlahBalitaPerempuan[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)', 'rgb(255, 193, 7)'],
      }
    ]
  }; --}}

  const data5 = {
    labels: ['Laki-laki', 'Perempuan'],
    datasets: [
      {
        label: 'Dataset 4',
        data: [{{ $dataJumlahBalitaLaki[0]->jumlah }}, {{ $dataJumlahBalitaPerempuan[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)', 'rgb(255, 193, 7)'],
      }
    ]
  };
  
  const data6 = {
    labels: [
      @foreach($dataJumlahBalitaUmur as $d)
       @if($d->umur == 0)
                '1-12 Bulan',
            @elseif($d->umur == 1)
                '13-24 Bulan',
            @elseif($d->umur == 2)
                '25-36 Bulan',
            @elseif($d->umur == 3)
                '37-48 Bulan',
            @elseif($d->umur == 4)
                '49-60 Bulan',
            @elseif($d->umur == 5)
                '61-72 Bulan',
            @elseif($d->umur == 6)
                '73-84 Bulan',
            @elseif($d->umur == 7)
                '85-96 Bulan',
            @else
                '>97 Bulan',
        @endif
        
      @endforeach
    ],
    datasets: [
      {
        label: 'Dataset 5',
        data: [
          @foreach($dataJumlahBalitaUmur as $d)
            {{ $d->jumlah }},
          @endforeach
        ],
        backgroundColor: [
          @foreach($dataJumlahBalitaUmur as $d)
            'rgb({{ rand(1,255) }}, {{ rand(1,255) }}, {{ rand(1,255) }})',
          @endforeach
        ],
      }
    ]
  };  

  var options5 = {
    tooltips: {
      enabled: true
    },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          const datapoints = ctx.chart.data.datasets[0].data
          const total = datapoints.reduce((total, datapoint) => total + datapoint, 0)
          const percentage = value / total * 100
          return percentage.toFixed(2) + "%";
        },
        color: '#fff',
      }
    }
  };

  var options6 = {
    tooltips: {
      enabled: true
    },
    plugins: {
        datalabels: {
            formatter: (value, ctx) => {
                let sum = 0;
                let dataArr = ctx.chart.data.datasets[0].data;
                dataArr.map(data => {
                    sum += data;
                });
                let percentage = (value*100 / sum).toFixed(2)+"%";
                return percentage;
            },
            color: '#fff',
        }
    }
  };

  

  // const config5 = {
  //   type: 'pie',
  //   data: data5,
  //   options: {
  //     responsive: true,
  //     plugins: {
  //       legend: {
  //         position: 'top',
  //       },
  //       title: {
  //         display: true,
  //         text: 'Grafik Balita (Berdasarkan kelamin)'
  //       }
  //     }
  //   },
  // };
  const config5 = {
    type: 'pie',
    data: data5,
    options: options5
  };

  const config6 = {
    type: 'pie',
    data: data6,
    options: options6
  };


  const pieChart5 = new Chart(
    document.getElementById('pieChart5'),
    config5
  );
  
  var ctx5 = document.getElementById("pieChart5").getContext('2d');
  var myChart5 = new Chart(ctx5, config5);

  var ctx6 = document.getElementById("pieChart6").getContext('2d');
  const pieChart6 = new Chart(ctx6, config6);
</script>
@endsection