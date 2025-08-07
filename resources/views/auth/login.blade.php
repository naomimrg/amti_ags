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

      <title>{{ config('app.name') }} | Login</title>

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
<div class="row" id="login-box" style="">
  <div class="col-12 col-sm-7 col-md-7 col-lg-7" id="left-login" style="">
    <h2 style="color:white;">Welcome back!</h2>
    <h1 style="color:white;
    font-weight: bold;
    line-height: 1em;">Log in to your<br>Account</h1>
  </div>
  <div class="col-12 col-sm-5 col-md-5 col-lg-5">
  <div class="container-xxl">
      
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner" style="max-width: 300px;">
          <!-- Register -->
          <div class="card" style="background: #0000006b;border-radius: 25px;">
            <div class="card-body">
              <!-- Logo -->
              <div class="justify-content-center">
                <h5 style="color:white;padding:10px;text-align: center;">LOGIN</h5>
              </div>
              <!-- /Logo -->
              <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}" style="padding-left:20px;padding-right:20px;">
                @csrf
                <div class="mb-3">
                 
                  <input style="background:#817b84;border-radius:15px;border:none;color:white;"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    placeholder="email"
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="off" autofocus/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                 
                  <div class="input-group input-group-merge">
                 
                    <input style="background:#817b84;border-radius:15px;border:none;color:white;"
                      type="password"
                      id="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password"
                      placeholder="password"
                      aria-describedby="password" required autocomplete="off"/>
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input style="border-radius: 10px;font-size: 13px;background: #d7d7d7;border: none;" class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <center>
                  <button class="btn  d-grid w-50" style="background:#6e56ff;color:white;width: 70%!important;border-radius: 25px;text-transform: uppercase;" type="submit">{{ __('Login') }}</button></center>
                </div>
                   <center> 
                    <a style="color:gray;" href="{{ url('/password/reset')}}">
                      <small>Forgot your password?</small>
                    </a>
                  </center>
                  
              </form>
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
