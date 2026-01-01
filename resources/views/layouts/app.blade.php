<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>High Bloom</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Light Mode Logo.png') }}">

    <!-- Apple Touch Icon -->
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        /* Full-screen loader overlay */
        #pageLoader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #121e3e;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #pageLoader .loader-content img {
            width: 100%;
            height: auto;
        }

        .form-control.is-invalid {
            border-color: #ff4d4d !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 77, 77, 0.25);
            background-image: none;
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>

    @stack('styles')
</head>

<body>

<!-- Screen Loader -->
<div id="pageLoader">
    <div class="loader-content">
        <img src="{{ asset('assets/img/screen-loader.gif') }}" alt="Loading...">
    </div>
</div>

<!-- Toasts -->
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>

<!-- Header -->
@include('partial.header')

<!-- Sidebar -->
@include('partial.sidebar')

<!-- Main Content -->
<main id="main" class="main">
    @yield('content')
</main>

<!-- Footer -->
@include('partial.footer')

<!-- Back to top -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            setTimeout(() => {
                loader.style.transition = 'opacity 0.5s ease';
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }, 800); // reduced delay (better UX)
        }
    });
</script>

@stack('scripts')

</body>
</html>
