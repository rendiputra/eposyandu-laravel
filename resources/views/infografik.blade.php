@extends('layouts.front')
@section('title','Artikel')
@section('content')


  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="{{url('/')}}"><img class="d-inline-block me-3" src="{{ asset('asset/img/LogoEposyandu3.png') }}" alt="" style="height: 41px;"/>E-Posyandu</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('article')}}">Artikel</a></li>
            <li class="nav-item"><a class="nav-link fw-bold active" href="{{route('article')}}">Info Grafik</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Masuk</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="content">
      <div class="container-fluid">
        <div class="row text-center justify-content-center">
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
                  <h3 class="card-title">Grafik Balita (Berdasarkan jenis kelamin)</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="pieChart3" height="100"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Usia Balita (Bulan)</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="pieChart4" height="100"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Balita Stunting Laki-Laki (bulan ini)</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="pieChart5" height="100"></canvas>
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
    configPemeriksaanBulanan
  );
</script>


<script>

  const data2 = {
    labels: ['Balita'],
    datasets: [
      {
        label: 'Dataset 1',
        data: [{{ $dataJumlahBalita[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)'],
      }
    ]
  };

  const data3 = {
    labels: ['Laki-laki', 'Perempuan'],
    datasets: [
      {
        label: 'Balita',
        data: [{{ $dataJumlahBalitaLaki[0]->jumlah }}, {{ $dataJumlahBalitaPerempuan[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)', 'rgb(255, 193, 7)'],
      }
    ]
  };

  const data4 = {
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
        label: 'Balita',
        data: [
          @foreach($dataJumlahBalitaUmur as $d)
            '{{ $d->jumlah }}',
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

  const data5 = {
    labels: [
      @foreach($dataStuntingLaki as $d)
        '{{ $d->status_stunting }}',
      @endforeach
    ],
    datasets: [
      {
        label: 'Balita',
        data: [
          @foreach($dataStuntingLaki as $d)
            '{{ $d->jumlah }}',
          @endforeach
        ],
        backgroundColor: [
          @foreach($dataStuntingLaki as $d)
            'rgb({{ rand(1,255) }}, {{ rand(1,255) }}, {{ rand(1,255) }})',
          @endforeach
        ],
      }
    ]
  };  

  const config3 = {
    type: 'pie',
    data: data3,
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

  const config4 = {
    type: 'pie',
    data: data4,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Usia Balita (Bulan)'
        }
      }
    },
  };

  const config5 = {
    type: 'pie',
    data: data5,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Status Gizi Balita Laki-Laki'
        }
      }
    },
  };

  const pieChart3 = new Chart(
    document.getElementById('pieChart3'),
    config3
  );

  const pieChart4 = new Chart(
    document.getElementById('pieChart4'),
    config4
  );

  const pieChart5 = new Chart(
    document.getElementById('pieChart5'),
    config5
  );

</script>
@endsection