<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>SPPD</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <script src="https://kit.fontawesome.com/7b8a3723b6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/css/cekstyle.css') }}" />




    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/css/demo.css') }}" />
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <!-- jika menggunakan bootstrap4 gunakan css ini  -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/vendor/libs/apex-charts/apex-charts.css') }}" />



    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat-1.0.0/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat-1.0.0/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

      @php
          $f = session('brand_logo');
      @endphp

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-dark">

           <div class="container ">
              <div class="d-flex justify-content-center ">
                <a href="{{ url('index') }}" class="app-brand-link">
                  <span class="app-brand-logo demo">
                    @if (isset($f))
                    <img src="{{ asset('logo/sragen.png' ) }}"  alt="" style="width: 65px;height:65px; align-items:center" class="ms-2 mt-3 ">
                    @endif

                  </span>


                </a>
              </div>
            </div>

             <div class="container bg-dark">
              <div class="d-flex justify-content-center bg-dark">
                <h4 class="ms-3 mt-2 text-white">INSPEKTORAT </h4>
              </div>
            </div>
            <div class="container bg-dark">
              <div class="d-flex justify-content-center bg-dark">
                <h4 class="ms-3 text-white">SRAGEN</h4>
              </div>
            </div>


            <ul class="menu-inner py-1 mt-3 bg-dark text-white">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="{{ url('index') }}" class="menu-link text-white">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>


            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">DATA MASTER</span>
            </li>

            <li class="menu-item ">
              <a href="{{ url('skpd') }}" class="menu-link text-white">
                <i class="menu-icon fas fa-landmark "></i>
                <div data-i18n="Analytics">SKPD</div>
              </a>
            </li>

            <li class="menu-item ">
              <a href="{{ url('pangkat') }}" class="menu-link text-white">
                <i class="menu-icon fas fa-sort"></i>
                <div data-i18n="Analytics">Daftar Pangkat</div>
              </a>
            </li>

            {{-- <li class="menu-item ">
              <a href="{{ url('irban') }}" class="menu-link text-white">
              <i class="menu-icon fas fa-users"></i>
                <div data-i18n="Analytics">Daftar Irban</div>
              </a>
            </li> --}}

            <li class="menu-item ">
             <a href="{{ url('jabatan') }}" class="menu-link text-white">
                <i class="menu-icon fas fa-sort"></i>
               <div data-i18n="Analytics">Daftar Jabatan</div>
             </a>
           </li>
            <li class="menu-item ">
              <a href="{{ url('eselon') }}" class="menu-link text-white">
               <i class="menu-icon fas fa-crown"></i>
                <div data-i18n="Analytics">Daftar Eselon</div>
              </a>
            </li>

              {{-- <li class="menu-item ">
              <a href="{{ url('kendaraan') }}" class="menu-link text-white">
                <i class="menu-icon fas fa-car"></i>
                <div data-i18n="Analytics">Daftar Kendaraan</div>
              </a>
            </li> --}}

            <li class="menu-item ">
              <a href="{{ url('pegawai') }}" class="menu-link text-white">
                <i class="menu-icon fas fa-users"></i>
                <div data-i18n="Analytics">Daftar Pegawai</div>
              </a>
            </li>

            <li class="menu-item ">
              <a href="{{ url('kegiatan') }}" class="menu-link text-white">
                <i class="menu-icon far fa-clone"></i>
                <div data-i18n="Analytics">Daftar Kegiatan</div>
              </a>
            </li>

            <li class="menu-item ">
              <a href="{{ url('obrik') }}" class="menu-link text-white">
                <i class="menu-icon far fa-clipboard"></i>
                <div data-i18n="Analytics">Daftar Obrik</div>
              </a>
            </li>

            <li class="menu-item ">
              <a href="{{ url('jenisPengawasan') }}" class="menu-link text-white">
                <i class="menu-icon far fa-clipboard"></i>
                <div data-i18n="Analytics">Daftar Jenis Pengawasan</div>
              </a>
            </li>

            <li class="menu-item ">
              <a href="{{ url('Peran') }}" class="menu-link text-white">
                <i class="menu-icon fas fa-users"></i>
                <div data-i18n="Analytics">Daftar Peran</div>
              </a>
            </li>


            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">DATA TRANSAKSI</span>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link text-white menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Surat Tugas dan SPPD</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ url('surat_dalamKota') }}" class="menu-link text-white">
                    <div data-i18n="Without menu">Perjalanan Dinas Dalam Daerah</div>
                  </a>
                </li>

              </ul>
            </li>

            <li class="menu-item ">
              <a href="{{ url('arsip') }}" class="menu-link text-white">
                 <i class="menu-icon fas fa-book"></i>
                <div data-i18n="Analytics">Arsip</div>
              </a>
            </li>

              <li class="menu-header small text-uppercase">
              <span class="menu-header-text">DATA LAPORAN</span>
            </li>



            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link text-white menu-toggle">
                <i class="menu-icon fas fa-book"></i>
                <div data-i18n="Layouts">Laporan Surat Tugas PDF </div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="{{ url('laporanKegiatanPDF') }}" class="menu-link text-white">
                    <div data-i18n="Without menu">Rekap PDF</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="{{ url('laporanKegiatanPDF') }}" class="menu-link text-white">
                    <div data-i18n="Without menu">Berdasarkan Jenis Kegiatan</div>
                  </a>
                </li>


              </ul>
            </li>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-dark"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  {{-- <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  /> --}}
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center  ms-auto">
                <!-- Place this tag where you want the button to render. -->
                {{-- <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li> --}}
                <div class="col-xl-8 ">
                  <form action="{{ url('ubahtahun') }}" method="post">
                    @method('post')
                    @csrf
                     <select name="tahun" id="tahun" class="form-control" onchange="submit()">
                     <option value="">PILIH TAHUN</option>
                     @for ($i = 2023; $i <= date('Y'); $i++)
<option value="{{ $i }}" @if ($i == session('sdata')) selected @endif>{{ $i }}</option>
@endfor
                  </select>
                  </form>

                </div>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('sneat-1.0.0/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('sneat-1.0.0/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"></span>
                            <small class="text-muted">{{ session('name') }}</small>
                            <small class="text-muted">{{ session('username') }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                   <li>
                      <a class="dropdown-item" href="{{ url('logout') }}">
                       <i class="fas fa-sign-out-alt"> <span class="align-middle">Logout</span></i>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
           <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                        <div class="card-body">
                          @yield('content')
                        </div>
                      </div>
                    </div>
                  </div>
                </div>










                <!--/ Transactions -->
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-dark">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <style>
                  .as{
                    color: white
                  }
                </style>
                <div class="mb-2 mb-md-0 as">
                   Inspektorat Daerah Kab. Sragen ©
                  <script>
                      document.write(new Date().getFullYear());
                  </script>
                </div>
                <div>
                  <style>
                    .cek{
                      color: greenyellow;
                    }
                    .cek:hover{
                      color: green;
                      text-decoration: underline;
                    }
                  </style>
                <div class="d-flex justify-content-end "> Design By &nbsp; <a href="#" class="cek">  Inspektorat Daerah Kab. Sragen </a> </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
       <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('sneat-1.0.0/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat-1.0.0/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat-1.0.0/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('sneat-1.0.0/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('sneat-1.0.0/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('sneat-1.0.0/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('sneat-1.0.0/assets/js/dashboards-analytics.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
     {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <!-- js untuk bootstrap4  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script> --}}
        <!-- js untuk select2  -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
