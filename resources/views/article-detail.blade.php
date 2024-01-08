@extends('layouts.front')
@section('title','Artikel')
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
              <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#tentang">Tentang Posyandu</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('infografik_balita') }}">Info Grafik</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#tka">Tumbuh Kembang Anak</a></li>
              <li class="nav-item"><a class="nav-link fw-bold active" href="{{ route('article') }}">Artikel</a></li>
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
    
      <section id="artikel" class="py-8">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/article-bg.png')}});background-position:right center;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
          <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:left top;background-size:initial;margin-top:120px;margin-left:-35px;">
          </div>
          <!--/.bg-holder-->

          <div class="row flex-center">
          </div>
          <div class="row h-100 justify-content-center pt-6">
            <div class="col-12 col-md-9">
                <div class="text-center">
                <h2 class="fw-bold">{{ $artikel->title }}</h2>
                <hr class="mx-auto text-dark" style="height:2px;width:50px" />
                </div>
              <div class="card rounded-3 shadow"><img class="card-img-top" src="{{asset('image/'.$artikel->image)}}" alt=""  width="100%" loading="lazy"/>
                <div class="card-body p-4 text-center text-md-start">
                <span>Oleh: {{$artikel->username}} | Diperbaharui pada tanggal {{ date('d M Y H:i:s',strtotime($artikel->updated_at)) }}</span>
                  <p class="card-text">{!! $artikel->description !!}</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
            @if(count($allarticle) > 0)
                <div class="sticky-top" style="z-index: 0; top: 100px;">
                    <div class="text-center">
                    <h4 class="fw-bold">Artikel Lainnya</h4>
                    <hr class="mx-auto text-dark" style="height:2px;width:50px" />
                    </div>
                  <div class="card rounded-3 shadow">
                    @foreach($allarticle as $a)
                    <a href="{{ route('article-detail', $a->slug) }}" style="">
                      <div class="row g-0">
                            <div class="col-md-4">
                            <img style="width:80px; height:80px; border-radius: 1.25rem 0 0 1.25rem;" src="{{asset('image/'.$a->image)}}" class="img-fluid" alt="..." width="100%" loading="lazy">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{(strlen(strip_tags($a->title)) > 25 ) ? substr_replace(strip_tags($a->title),'...',25) : $a->title;}}</h5>
                            </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                  </div>
                </div>
            @endif
            </div>
          </div>
        </div>
      </section>
      <section class="py-6 pt-6 bg-primary-gradient">
        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot.png')}});background-position:left bottom;background-size:auto;filter:contrast(1.5);">
        </div>
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url({{asset('asset/img/illustrations/dot-2.png')}});background-position:right top;background-size:auto;margin-top:-75px;">
        </div>
        <!--/.bg-holder-->

        {{-- <div class="container">
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
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Bekasi</span></li>
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 2: Jl. Lorem ipsum dolor sit amet consectetur.</span></li>
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 3: Jl. Lorem ipsum dolor sit amet consectetur.</span></li>
              </ul>
            </div>
          </div>
        </div> --}}
        <div class="container">
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