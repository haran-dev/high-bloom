<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>High Bloom | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/Light Mode Logo.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --blue-main: #4dabff;
            --blue-accent: #0078d1;
            --glass-bg: rgba(255, 255, 255, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: radial-gradient(circle at top left, #132042, #070b14);
            color: #e5e7eb;
        }

        /* ===== Background Container (FIX) ===== */
        .bg-effects {
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        /* ===== Floating Orbs ===== */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.45;
            animation: float 20s infinite ease-in-out;
        }

        .orb.one {
            width: 320px;
            height: 320px;
            background: #0078d1;
            top: -120px;
            left: -120px;
        }

        .orb.two {
            width: 420px;
            height: 420px;
            background: #4dabff;
            bottom: -160px;
            right: -160px;
            animation-delay: 6s;
        }

        .orb.three {
            width: 260px;
            height: 260px;
            background: #ffffff;
            top: 40%;
            left: 60%;
            opacity: 0.15;
            animation-delay: 12s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-70px); }
        }

        /* ===== Layout ===== */
        .wrapper {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ===== Glass Card ===== */
        .login-box {
            width: 100%;
            max-width: 420px;
            padding: 46px;
            background: var(--glass-bg);
            border-radius: 22px;
            backdrop-filter: blur(22px);
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.6);
            animation: slideUp 0.9s ease forwards;
            transition: transform 0.1s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== Brand ===== */
        .brand {
            text-align: center;
            margin-bottom: 36px;
        }

        .brand img {
            max-width: 100%;
            height: auto;
        }

        /* ===== Inputs ===== */
        .form-control {
            height: 52px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.16);
            border-color: var(--blue-main);
            box-shadow: 0 0 0 0.2rem rgba(77, 171, 255, 0.25);
            color: #ffffff;
        }

        /* ===== Validation ===== */
        .was-validated .form-control:invalid {
            border-color: #ff6b6b;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
        }

        .was-validated .form-control:valid {
            border-color: #4dabff;
        }

        /* ===== Options ===== */
        .options {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 26px;
        }

        .options a {
            color: var(--blue-main);
            text-decoration: none;
        }

        /* ===== Button ===== */
        .btn-login {
            height: 52px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #4dabff, #0078d1);
            color: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(77, 171, 255, 0.4);
        }

        /* ===== Footer ===== */
        .footer {
            margin-top: 28px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }

        /* ===== Mobile ===== */
        @media (max-width: 576px) {
            .login-box {
                padding: 32px 24px;
            }

            .options {
                flex-direction: column;
                gap: 10px;
            }
        }




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
            width: 100% !important;  
            height: auto;
        }



    </style>
</head>

<body>

    <!-- Screen Loader -->
    <div id="pageLoader">
        <div class="loader-content">
            <img src="assets/img/screen-loader.gif" alt="Loading..." class="loader-gif">
        </div>
    </div>



    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>


    <!-- Background (NO SCROLLBAR FIXED) -->
    <div class="bg-effects">
        <div class="orb one"></div>
        <div class="orb two"></div>
        <div class="orb three"></div>
    </div>

    <!-- Login -->
    <div class="wrapper">
        <div class="login-box">
            <div class="brand">
                <img src="assets/img/high_bloom_logo1.png" alt="High Bloom Logo" width="280">
            </div>
            <form class="needs-validation" novalidate>
                @csrf
                <div class="position-relative mb-3">
                    <input type="email" class="form-control" placeholder="Email address" required>
                    <div class="invalid-feedback">Email is required.</div>
                </div>
                <div class="position-relative mb-3">
                    <input type="password" id="password" class="form-control" placeholder="Password" required>
                    <div class="invalid-feedback">Password is required.</div>
                </div>
                <div class="options">
                    <label style="cursor:pointer;">
                        <input type="checkbox" id="togglePasswordCheckbox">
                        <span id="togglePasswordLabel">Show Password</span>
                    </label>
                </div>
                <button type="submit" data-url="user/login" class="btn btn-login w-100 submit-form">
                    <span class="btn-text">Sign In</span>
                    <span class="spinner-border spinner-border-sm d-none ms-2"
                        role="status"
                        aria-hidden="true">
                    </span>
                </button>
            </form>
            <div class="footer">
                © 2025 High Bloom Softwares. All rights reserved.
            </div>
        </div>
    </div>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/passwordToggle.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/notificationHandler.js"></script>
    <script src="assets/js/formSubmit.js"></script>


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
                }, 3500);
            }
        });
    </script>

</body>
</html>
