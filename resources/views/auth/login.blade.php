<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
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
    <link rel="stylesheet" href="{{ url('/assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
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

<body
    style="background-image:url('{{ url('/assets') }}/img/wallbee_us.jpg');background-repeat:no-repeat;background-size:cover;height:100vh;width:100%;">
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
                        {{-- Tambahkan di bagian head layout atau view --}}
                        <script
                            src="https://www.google.com/recaptcha/api.js?render={{ $recaptchaSiteKey ?? '6LfDfaMrAAAAHircomP-Vqjo_iy_bliqwEey5YD' }}">
                        </script>

                        <div class="card" style="background: #0000006b;border-radius: 25px;">
                            <div class="card-body">
                                <!-- Logo -->
                                <div class="justify-content-center">
                                    <h5 style="color:white;padding:10px;text-align: center;">LOGIN</h5>
                                </div>
                                <!-- /Logo -->

                                {{-- Loading/Status Alert --}}
                                <div id="statusAlert" class="alert"
                                    style="display: none; margin: 15px 20px; border-radius: 15px;"></div>

                                <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}"
                                    style="padding-left:20px;padding-right:20px;">
                                    @csrf

                                    <div class="mb-3">
                                        <input style="background:#817b84;border-radius:15px;border:none;color:white;"
                                            type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="email" value="{{ old('email') }}"
                                            required autocomplete="off" autofocus />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <input
                                                style="background:#817b84;border-radius:15px;border:none;color:white;"
                                                type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="password" aria-describedby="password"
                                                required autocomplete="off" />
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Hidden field untuk reCAPTCHA v3 token --}}
                                    <input type="hidden" name="g-recaptcha-response" id="recaptchaToken">

                                    {{-- Error handling untuk reCAPTCHA --}}
                                    @error('g-recaptcha-response')
                                    <div class="mb-3">
                                        <span class="text-danger"
                                            style="color: #ff6b6b !important;">{{ $message }}</span>
                                    </div>
                                    @enderror

                                    @error('recaptcha')
                                    <div class="mb-3">
                                        <span class="text-danger"
                                            style="color: #ff6b6b !important;">{{ $message }}</span>
                                    </div>
                                    @enderror

                                    {{-- reCAPTCHA v3 Info --}}
                                    <div class="mb-3">
                                        <small
                                            style="color: #ccc; text-align: center; display: block; font-size: 11px;">
                                            🛡️ Protected by reCAPTCHA v3
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <center>
                                            <button id="loginBtn" class="btn d-grid w-50"
                                                style="background:#6e56ff;color:white;width: 70%!important;border-radius: 25px;text-transform: uppercase;position: relative;"
                                                type="submit">
                                                <span id="btnText">{{ __('Login') }}</span>
                                                <div id="loadingSpinner" style="display: none;">
                                                    <div
                                                        style="width: 20px; height: 20px; border: 2px solid #ffffff; border-top: 2px solid transparent; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto;">
                                                    </div>
                                                </div>
                                            </button>
                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <style>
                        @keyframes spin {
                            0% {
                                transform: rotate(0deg);
                            }

                            100% {
                                transform: rotate(360deg);
                            }
                        }

                        .alert {
                            padding: 10px 15px;
                            border-radius: 15px;
                            font-size: 14px;
                        }

                        .alert-success {
                            background: rgba(40, 167, 69, 0.8);
                            color: white;
                            border: 1px solid rgba(40, 167, 69, 0.5);
                        }

                        .alert-error {
                            background: rgba(220, 53, 69, 0.8);
                            color: white;
                            border: 1px solid rgba(220, 53, 69, 0.5);
                        }

                        .alert-info {
                            background: rgba(23, 162, 184, 0.8);
                            color: white;
                            border: 1px solid rgba(23, 162, 184, 0.5);
                        }

                        #loginBtn:disabled {
                            opacity: 0.7;
                            cursor: not-allowed;
                        }
                        </style>

                        <script>
                        grecaptcha.ready(function() {
                            console.log('reCAPTCHA v3 loaded successfully');

                            const form = document.getElementById('formAuthentication');
                            const statusAlert = document.getElementById('statusAlert');
                            const loginBtn = document.getElementById('loginBtn');
                            const btnText = document.getElementById('btnText');
                            const spinner = document.getElementById('loadingSpinner');

                            form.addEventListener('submit', function(e) {
                                e.preventDefault();

                                // Show loading state
                                setLoadingState(true);
                                showAlert('🔐 Verifying security...', 'info');

                                // Execute reCAPTCHA v3
                                grecaptcha.execute(
                                    '{{ $recaptchaSiteKey ?? "6LfDfaMrAAAAHircomP-Vqjo_iy_bliqwEey5YD" }}', {
                                        action: 'login'
                                    }).then(function(token) {
                                    console.log('reCAPTCHA token received');

                                    // Set token di hidden field
                                    document.getElementById('recaptchaToken').value = token;

                                    // Submit form secara normal (bukan AJAX)
                                    showAlert('✅ Security verified, logging in...', 'success');

                                    // Delay sedikit untuk user experience
                                    setTimeout(() => {
                                        form.submit();
                                    }, 800);

                                }).catch(function(error) {
                                    console.error('reCAPTCHA error:', error);
                                    showAlert(
                                        '❌ Security verification failed. Please refresh and try again.',
                                        'error');
                                    setLoadingState(false);
                                });
                            });

                            function setLoadingState(loading) {
                                loginBtn.disabled = loading;
                                if (loading) {
                                    btnText.style.display = 'none';
                                    spinner.style.display = 'block';
                                } else {
                                    btnText.style.display = 'block';
                                    spinner.style.display = 'none';
                                }
                            }

                            function showAlert(message, type) {
                                statusAlert.innerHTML = message;
                                statusAlert.className = 'alert alert-' + type;
                                statusAlert.style.display = 'block';

                                // Auto hide success messages
                                if (type === 'success') {
                                    setTimeout(() => {
                                        statusAlert.style.display = 'none';
                                    }, 3000);
                                }
                            }

                            // Hide alert when user starts typing
                            ['email', 'password'].forEach(id => {
                                document.getElementById(id).addEventListener('input', function() {
                                    if (statusAlert.style.display !== 'none') {
                                        statusAlert.style.display = 'none';
                                    }
                                });
                            });
                        });

                        // Test function untuk debugging (hapus di production)
                        function testRecaptcha() {
                            grecaptcha.execute('{{ $recaptchaSiteKey ?? "6LfDfaMrAAAAHircomP-Vqjo_iy_bliqwEey5YD" }}', {
                                action: 'test'
                            }).then(function(token) {
                                console.log('Test reCAPTCHA token:', token.substring(0, 20) + '...');

                                fetch('{{ route("test.recaptcha") ?? "/test-recaptcha" }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            token: token,
                                            action: 'test'
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('reCAPTCHA Test Result:', data);
                                    })
                                    .catch(error => {
                                        console.error('Test error:', error);
                                    });
                            });
                        }
                        </script>
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