<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>High Bloom</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">


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

    <div id="modal-view" class="modal fade">
    </div>

    <div class="page-wrapper">

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

    </div>

    <!-- Back to top -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color: #121e3e;">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- jQuery (optional – Bootstrap 5 does NOT need it) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Bundle (ONLY ONCE) -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Custom JS -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const countEl = document.getElementById('notification-count');
            const countHeader = document.getElementById('notification-count-header');
            const headerBlock = document.getElementById('notification-header-data');
            const emptyBlock = document.getElementById('empty-notification');

            function updateUI(newCount) {
                if (newCount <= 0) {
                    // Hide count badge
                    countEl.style.display = 'none';

                    // Hide header
                    if (headerBlock) headerBlock.remove();

                    // Show empty message
                    emptyBlock.classList.remove('d-none');
                } else {
                    // Show count badge
                    countEl.style.display = 'inline-block';
                    countEl.textContent = newCount;
                    countHeader.textContent = newCount;
                }
            }

            /* ============================
               MARK ALL AS READ
            ============================ */
            document.getElementById('mark-all-read')?.addEventListener('click', function(e) {
                e.preventDefault();

                fetch("{{ route('notifications.markAllRead') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status) {

                            // Remove all notifications
                            document.querySelectorAll('.notification-item').forEach(el => el.remove());
                            document.querySelectorAll('.dropdown-divider').forEach(el => el.remove());

                            // Update UI
                            updateUI(0);
                        }
                    });
            });

            /* ============================
               MARK SINGLE AS READ
            ============================ */
            document.querySelectorAll('.mark-read-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;

                    fetch(`{{ url('notifications') }}/${id}/mark-read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status) {
                                const li = document.getElementById('notification-' + id);
                                li.nextElementSibling?.remove(); // divider
                                li.remove();

                                let currentCount = parseInt(countEl.textContent) || 0;
                                updateUI(currentCount - 1);
                            }
                        });
                });
            });

        });
    </script>



<script>
function timeAgo(dateString) {
    const date = new Date(dateString);
    const seconds = Math.floor((Date.now() - date.getTime()) / 1000);

    if (seconds < 0) return 'just now';

    const intervals = [
        { label: 'year', seconds: 31536000 },
        { label: 'month', seconds: 2592000 },
        { label: 'day', seconds: 86400 },
        { label: 'hour', seconds: 3600 },
        { label: 'minute', seconds: 60 },
    ];

    for (const interval of intervals) {
        const count = Math.floor(seconds / interval.seconds);
        if (count >= 1) {
            return `${count} ${interval.label}${count > 1 ? 's' : ''} ago`;
        }
    }

    return 'just now';
}

function updateTimes() {
    document.querySelectorAll('.time-ago').forEach(el => {
        el.textContent = timeAgo(el.dataset.time);
    });
}

document.querySelector('[data-bs-toggle="dropdown"]')
    ?.addEventListener('click', updateTimes);

setInterval(updateTimes, 60000);
</script>







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
                }, 800);
            }
        });
    </script>

    @stack('scripts')

</body>

</html>