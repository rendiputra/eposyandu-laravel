@extends('layouts.front')
@section('title','Artikel')
@section('content')
<style>
  .card
  {
      margin-bottom: 25px;
  }
  .card-img-top 
  {
      width: 100%;
      height: 300px;
      object-fit: cover;
  }
  </style>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2" href="{{url('/')}}"><img class="d-inline-block me-3" src="{{asset('asset/img/icons/logo.png')}}" alt="" />E-Posyandu</a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
              <li class="nav-item"><a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a></li>
              <li class="nav-item"><a class="nav-link fw-bold active" href="{{route('article')}}">Artikel</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Masuk</a></li>
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
            <div class="col-auto text-center">
              <h2 class="fw-bold">Artikel</h2>
              <hr class="mx-auto text-dark" style="height:2px;width:50px" />
            </div>
          </div>
          <div class="row h-100 justify-content-center pt-6">
            @if(count($artikel) > 0)
            @foreach($artikel as $a)
            <div class="col-12 col-sm-9 col-md-4 mt-4">
              <div class="card rounded-3 shadow"><img class="card-img-top" src="{{asset('image/'.$a->image)}}" alt="" />
                <div class="card-body p-4 text-center text-md-start">
                  <h5 class="fw-bold">{{ (strlen(strip_tags($a->title)) > 25 ) ? substr_replace(strip_tags($a->title),'...',25) : $a->title; }}</h5>
                  <p class="card-text">{{ (strlen(strip_tags($a->description)) > 45 ) ? substr_replace(strip_tags($a->description),'...',50) : $a->description; }}</p><a class="stretched-link text-decoration-none" href="{{route('article-detail',$a->slug)}}" role="button">Lihat Selengkapnya
                    <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                    </svg></a>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <h4 class="text-center">Tidak ada artikel</h4>
            @endif
            <div class="text-center">
              <div class="d-flex justify-items-center text-center">
                {{ $artikel->links() }}
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
                {{-- <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 2: Jl. Lorem ipsum dolor sit amet consectetur.</span></li>
                <li class="lh-lg"><span class="text-light fs--1 text-decoration-none">Posyandu 3: Jl. Lorem ipsum dolor sit amet consectetur.</span></li> --}}
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