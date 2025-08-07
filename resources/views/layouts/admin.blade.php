<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template-free">
    <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} | @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets') }}/img/gsi-logo-transparent.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/css/custom.css" />
    <!-- Helpers -->
    <script src="{{ url('/assets') }}/vendor/js/helpers.js"></script>
    <script src="{{ url('/assets') }}/js/config.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/assets') }}/css/sweetalert2.min.css">
    <style>
      .layout-menu-fixed:not(.layout-menu-collapsed) .layout-page, .layout-menu-fixed-offcanvas:not(.layout-menu-collapsed) .layout-page{
        padding-left: 0;
      }
    </style>
    @yield('style')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <div style="padding: 10px;height: 100vh;">
        <div style="box-shadow: none;border-radius:25px;height:100%;" id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
                <center><img src="{{ url('/assets') }}/img/gsi-logo-transparent.png" style="width:33%;"></center>
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            @canany(['isSuperAdmin','isAdminGSI'])
            <li class="menu-item">
              <a href="{{ url('/dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="dashboard">Home</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('/parameter')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="parameter">Default Sensor</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('/client_sensor')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div data-i18n="parameter">Sensor Client</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('/vendor')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail "></i>
                <div data-i18n="vendor">Manage User</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('/user')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div data-i18n="user">Manage Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('/admin')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div data-i18n="vendor">Manage Admin</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ url('/report')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-download"></i>
                <div data-i18n="report">Download Data</div>
              </a>
            </li>
            @endcan
            @canany(['isAdminVendor','isUser'])
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Extended UI">Home</div>
              </a>
              <ul class="menu-sub" id="loc-lists">

              </ul>
            </li>
            <li class="menu-item">
              <a href="{{ url('/report')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-download"></i>
                <div data-i18n="report">Download Data</div>
              </a>
            </li>

            @endcan
          </ul>
          <div style="padding: 20px;">
          <center>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn" style="background: #f37d14fa;color: white;">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
          </a></center>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          </div>

        </div>
      </div>
        <!-- / Menu -->
        <div class="layout-page">
          <!-- Navbar -->

          {{-- <nav style="border-radius: 20px;"
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div> --}}

            {{-- <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <h5 class="my-0 px-2 black" style="color: black;">Monitoring</h5>
              <!-- Search -->
              <div class="navbar-nav align-items-center" style="width: 70%;border-radius: 13px;padding-left: 10px;background: #f3f3f3;">
                <div class="nav-item d-flex align-items-center" style="    width: 100%;">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." style="background: transparent;width: 100%;">
                </div>
              </div>
              <!-- /Search --> --}}

              {{-- <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <i class='bx bx-sm bx-bell'></i>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online" id="avatar-logo-top">

                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online" id="avatar-logo-bottom">


                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ url('/profile')}}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul> --}}
            {{-- </div>
          </nav> --}}
          <!-- Content wrapper -->
         <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y" style="padding-top:10px!important;">
              <div class="row">
              <div class="col-12">
                  <p><label style="display:none;" class="hl"></label>Show: <span style="color: black;" id="datenow"></span></p>
                </div>
        @yield('content')

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
    <!-- build:js {{ url('/assets') }}/vendor/js/core.js -->

    <!--<script src="{{ url('/assets') }}/vendor/libs/jquery/jquery.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ url('/assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ url('/assets') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('/assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ url('/assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ url('/assets') }}/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ url('/assets') }}/js/sweetalert2.all.min.js"></script>
    <script type='text/javascript'>
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var thisDay = date.getDay(),
            thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        $('#datenow').html(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);

    </script>
    @can('isAdminVendor')

    <script>
       $.ajax({
          url: "{{ url('/getLoc') }}",
          dataType: "json",
          success: function (data) {
            $.each(data.items, function(index, item) {
              $('#loc-lists').append('<li class="menu-item"><a href="{{ url("/home")}}/'+item.slug+'" class="menu-link"><div data-i18n="'+item.nama_lokasi+'">'+item.nama_lokasi+'</div></a></li>');
            });
          }
      });
    </script>
    @endcan
    @yield('script')
    {{-- <script>
    $.ajax({
        url: "{{ url('/getProfile') }}",
        dataType: "json",
        success: function (data) {

            $('#avatar-logo-top').append('<img src="{{ url("/assets") }}/img/'+data.image+'" alt class="w-px-40 h-auto rounded-circle" />');
            $('#avatar-logo-bottom').append('<img src="{{ url("/assets") }}/img/'+data.image+'" alt class="w-px-40 h-auto rounded-circle" />');
        }
    });
	  </script> --}}
  </body>
</html>
