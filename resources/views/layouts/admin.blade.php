<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'E-Posyandu')</title>

  <!-- Google Font: Source Sans Pro -->
  <link prerender rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{-- <link prerender rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}"> --}}
  <link prerender rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

  <!-- Theme style -->
  {{-- <link prerender rel="stylesheet" href="{{ asset('dist-adminlte/css/adminlte.min.css')}}"> --}}
  <link prerender rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  <link rel="icon" type="img/ico" href="{{ asset('asset/img/LogoEposyandu2.ico') }}">
  <link rel="shortcut icon" href="{{ asset('asset/img/LogoEposyandu2.ico') }}">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('asset/img/LogoEposyandu3.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E-Posyandu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist-adminlte/img/avatar-icon.webp') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('user.update_akun') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @php
            $role = Auth::user()->role;
          @endphp
          <li class="nav-item">
            <a href="@if($role == 1){{ route('user.dashboard') }}@elseif($role == 2){{ route('kader.dashboard') }}@elseif($role == 4){{ route('admin.dashboard') }}@endif" class="nav-link @if (Request::is('user/dashboard','user/dashboard/*', 'kader/dashboard','kader/dashboard/*', 'admin/dashboard','admin/dashboard/*')) active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
  @if ($role == 4)
          <li class="nav-header">Admin Panel</li>
          <li class="nav-item">
            <a href="{{ route('admin.list_pemeriksaan_balita') }}" class="nav-link @if (Request::is('admin/pemeriksaan_balita','admin/pemeriksaan_balita/*','kader/pemeriksaan_balita/*')) active @endif">
              <i class="nav-icon fa-solid fa-hospital-user"></i>
              <p>Pemeriksaan Balita</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_akun') }}" class="nav-link @if (Request::is('admin/akun','admin/akun/*')) active @endif ">
              <i class="nav-icon fa-solid fa-user-tie"></i>
              <p>
                Data Akun
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_balita') }}" class="nav-link @if (Request::is('admin/balita','admin/balita/*')) active @endif">
              <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>Data Balita</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_posyandu') }}" class="nav-link @if (Request::is('admin/posyandu','admin/posyandu/*')) active @endif ">
              <i class="nav-icon fa-solid fa-hospital"></i>
              <p>
                Data Posyandu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_artikel') }}" class="nav-link @if (Request::is('admin/artikel','admin/artikel/*')) active @endif ">
              <i class="nav-icon fa-solid fa-newspaper"></i>
              <p>
                Artikel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_galeri') }}" class="nav-link @if (Request::is('admin/galeri','admin/galeri/*')) active @endif ">
              <i class="nav-icon fa-regular fa-images"></i>
              <p>
                Galeri
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_vaksin') }}" class="nav-link @if (Request::is('admin/vaksin','admin/vaksin/*')) active @endif ">
              <i class="nav-icon fa-solid fa-syringe"></i>
              <p>
                Vaksin
              </p>
            </a>
          </li>
  @endif
  @if ($role == 2 || $role == 4)
        @if($role == 2)
          <li class="nav-header">Data Pemeriksaan</li>
          <li class="nav-item">
            <a href="{{ route('kader.list_pemeriksaan_balita') }}" class="nav-link @if (Request::is('kader/pemeriksaan_balita','kader/pemeriksaan_balita/*')) active @endif">
              <i class="nav-icon fa-solid fa-hospital-user"></i>
              <p>Pemeriksaan Balita</p>
            </a>
          </li>
        @endif
          @if ($role == 2)
          <li class="nav-header">Data Peserta</li>
          <li class="nav-item">
            <a href="{{ route('kader.list_akun') }}" class="nav-link @if (Request::is('kader/akun','kader/akun/*')) active @endif ">
              <i class="nav-icon fa-solid fa-user-tie"></i>
              <p>
                Data Akun
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('kader.list_balita') }}" class="nav-link @if (Request::is('kader/balita','kader/balita/*')) active @endif">
              <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>Data Balita</p>
            </a>
          </li>
          @endif
  @endif
  @if ($role == 1 || $role == 2 || $role == 3 || $role == 4 )
          <li class="nav-header">Riwayat pemeriksaan keluarga</li>
            <li class="nav-item">
              <a href="{{ route('user.list_balita') }}" class="nav-link @if (Request::is('user/balita','user/balita/*')) active @endif">
                <i class="nav-icon far fa-solid fa-child"></i>
                <p>Balita</p>
              </a>
            </li>
  @endif
          
          <li class="nav-item">
            <a class="nav-link text-warning" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
              <i class="nav-icon fa fa-arrow-right-from-bracket"></i>
              <p>{{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2024 INSTITUT TEKNOLOGI TELKOM PURWORKERTO.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
{{-- <script async src="{{ asset('plugins/jquery/jquery.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
{{-- <script async src="{{ asset('dist-adminlte/js/adminlte.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('js')

</body>
</html>
