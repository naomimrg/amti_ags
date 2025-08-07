<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title>{{ config('app.name') }} | Forgot Password</title>

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
	    <link rel="stylesheet" href="{{ url('/assets') }}/css/custom.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="{{ url('/assets') }}/vendor/js/helpers.js"></script>
    <script src="{{ url('/assets') }}/js/config.js"></script>
  </head>

  <body style="background-image:url('{{ url('/assets') }}/img/wallbee_us.jpg');background-repeat:no-repeat;background-size:cover;height:100vh;width:100%;">
    <!-- Content -->
<div class="row" id="login-box" style="display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;">
  <div class="col-12 col-sm-6 col-md-6 col-lg-6">
  <div class="container-xxl">
      
      <div class="container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card" style="background: #000000c4;border-radius: 25px;">
            <div class="card-body">
              <!-- Logo -->
              <div class="justify-content-center">
                <h5 style="color:white;padding:10px;text-align: center;">RESET PASSWORD</h5>
              </div>
              <!-- /Logo -->
              <div class="col-12">
                <center>
                    <h5 style="color:white;">Silahkan hubungi admin melalui Whatsapp. <br> Untuk melakukan reset password</h5>
                    <h5  style="color:white;">Klik tombol dibawah ini</h5>
                    <a href="https://api.whatsapp.com/send?phone=" target="_blank"> 
                        <img src="{{ url('/assets') }}/img/wa-icon.png">
                    </a>
                </center>
                </div>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
  </div>
</div>


    <script src="{{ url('/assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ url('/assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ url('/assets') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ url('/assets') }}/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
