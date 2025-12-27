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
            --bg-dark: #0b1220;
            --glass-bg: rgba(255, 255, 255, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top left, #132042, #070b14);
            overflow: hidden;
            color: #e5e7eb;
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

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-70px);
            }
        }

        /* ===== Layout ===== */
        .wrapper {
            position: relative;
            z-index: 10;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== Glass Card ===== */
        .login-box {
            width: 420px;
            padding: 46px;
            background: var(--glass-bg);
            border-radius: 22px;
            backdrop-filter: blur(22px);
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.6);
            animation: slideUp 0.9s ease forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Brand ===== */
        .brand {
            text-align: center;
            margin-bottom: 36px;
        }

        .brand h1 {
            font-size: 30px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.4px;
        }

        .brand p {
            font-size: 14px;
            color: var(--blue-main);
            letter-spacing: 0.8px;
        }

        /* ===== Inputs ===== */
        .form-control {
            height: 52px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            margin-bottom: 18px;
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
            opacity: 0.9;
        }



        .login-box {
            width: 420px;
            padding: 46px;
            background: var(--glass-bg);
            border-radius: 22px;
            backdrop-filter: blur(22px);
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.6);
            animation: slideUp 0.9s ease forwards;
            transition: transform 0.1s ease-out;
            /* add this line */
        }
    </style>
</head>

<body>

    <!-- Animated Background -->
    <div class="orb one"></div>
    <div class="orb two"></div>
    <div class="orb three"></div>

    <!-- Login -->
    <div class="wrapper">
        <div class="login-box">
            <div class="brand text-center">
                <img src="assets/img/high_bloom_logo1.png" alt="High Bloom Logo" style="width: 280px; margin-bottom: 12px;">
            </div>

            <form>
                <input type="email" class="form-control" placeholder="Email address" required>
                <div class="position-relative mb-3">
                    <input type="password" id="password" class="form-control" placeholder="Password" required>
                    <i id="togglePassword" class="bi bi-eye" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af;"></i>
                </div>

                <div class="options">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-login w-100 form-submit" data-url="admin-login">
                    Sign In
                </button>
            </form>

            <div class="footer">
                © 2025 High Bloom Softwares. All rights reserved.
            </div>
        </div>
    </div>
</body>
<script src="assets/js/passwordToggle.js"></script>
</html>