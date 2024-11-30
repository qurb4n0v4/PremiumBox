<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/core/libs.min.css') }}">

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/hope-ui.min.css?v=5.0.0') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.min.css?v=5.0.0') }}">

    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/customizer.min.css?v=5.0.0') }}">

    <!-- RTL Css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/rtl.min.css?v=5.0.0') }}">
</head>
<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
<!-- loader Start -->
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="row m-0 align-items-center bg-white h-100">
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                <img src="{{ asset('assets/admin/images/auth/05.png') }}" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                            <div class="card-body">
                                <h2 class="mb-2 text-center">Sign Up</h2>
                                <p class="text-center">Create your admin account.</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="full-name" class="form-label">Full Name</label>
                                                <input type="text" name="name" class="form-control" id="full-name" placeholder=" " required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder=" " required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder=" " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                                <input type="password" name="password_confirmation" class="form-control" id="confirm-password" placeholder=" " required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Sign Up</button>
                                    </div>
                                </form>

{{--                                <p class="mt-3 text-center">--}}
{{--                                    Already have an Account <a href="{{ route('login') }}" class="text-underline">Sign In</a>--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sign-bg sign-bg-right">
                    <svg width="280" height="230" viewBox="0 0 421 359" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.05">
                            <rect x="-15.0845" y="154.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -15.0845 154.773)" fill="#3A57E8"/>
                            <rect x="149.47" y="319.328" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 149.47 319.328)" fill="#3A57E8"/>
                            <rect x="203.936" y="99.543" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 203.936 99.543)" fill="#3A57E8"/>
                            <rect x="204.316" y="-229.172" width="543" height="77.5714" rx="38.7857" transform="rotate(45 204.316 -229.172)" fill="#3A57E8"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Library Bundle Script -->
<script src="{{ asset('assets/admin/js/core/libs.min.js') }}"></script>

<!-- External Library Bundle Script -->
<script src="{{ asset('assets/admin/js/core/external.min.js') }}"></script>

<!-- Widgetchart Script -->
<script src="{{ asset('assets/admin/js/charts/widgetcharts.js') }}"></script>

<!-- mapchart Script -->
<script src="{{ asset('assets/admin/js/charts/vectore-chart.js') }}"></script>
<script src="{{ asset('assets/admin/js/charts/dashboard.js') }}"></script>

<!-- fslightbox Script -->
<script src="{{ asset('assets/admin/js/plugins/fslightbox.js') }}"></script>

<!-- Settings Script -->
<script src="{{ asset('assets/admin/js/plugins/setting.js') }}"></script>

<!-- Slider-tab Script -->
<script src="{{ asset('assets/admin/js/plugins/slider-tabs.js') }}"></script>

<!-- Form Wizard Script -->
<script src="{{ asset('assets/admin/js/plugins/form-wizard.js') }}"></script>

<!-- AOS Animation Plugin-->
<script src="{{ asset('assets/admin/js/hope-ui.js') }}" defer></script>
</body>
</html>
