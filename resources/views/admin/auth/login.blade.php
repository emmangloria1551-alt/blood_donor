<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | Community Blood Donor</title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            background: #f7f8fa;
            color: #172b4d;
        }

        /* =========================================
           MAIN CONTAINER
           ========================================= */

        .admin-login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .admin-login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;

            display: grid;
            grid-template-columns: 48% 52%;

            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;

            box-shadow:
                0 20px 60px rgba(16, 24, 40, 0.12);
        }

        /* =========================================
           LEFT SIDE
           ========================================= */

        .login-brand {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 55px;

            background:
                linear-gradient(
                    145deg,
                    #c8102e 0%,
                    #a30d25 55%,
                    #80091d 100%
                );

            color: #ffffff;
            overflow: hidden;
        }

        .login-brand::before {
            content: "";
            position: absolute;

            width: 330px;
            height: 330px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.07);

            top: -130px;
            right: -120px;
        }

        .login-brand::after {
            content: "";
            position: absolute;

            width: 260px;
            height: 260px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.06);

            bottom: -110px;
            left: -100px;
        }

        .brand-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 390px;
        }

        /* =========================================
           LOGO
           ========================================= */

        .brand-logo {
            width: 72px;
            height: 72px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #ffffff;
            color: #c8102e;

            border-radius: 20px;

            font-size: 34px;

            margin-bottom: 28px;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .brand-title {
            margin: 0;

            font-size: 32px;
            font-weight: 800;

            line-height: 1.15;

            letter-spacing: -0.7px;
        }

        .brand-subtitle {
            margin-top: 12px;
            margin-bottom: 0;

            color: rgba(255, 255, 255, 0.82);

            font-size: 15px;
            line-height: 1.7;
        }

        /* =========================================
           FEATURES
           ========================================= */

        .brand-features {
            margin-top: 38px;

            display: flex;
            flex-direction: column;
            gap: 17px;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 13px;

            color: rgba(255, 255, 255, 0.92);

            font-size: 14px;
        }

        .brand-feature-icon {
            width: 36px;
            height: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: rgba(255, 255, 255, 0.13);

            font-size: 16px;
        }

        /* =========================================
           RIGHT SIDE
           ========================================= */

        .login-form-section {
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 50px;
            background: #ffffff;
        }

        .login-form-container {
            width: 100%;
            max-width: 420px;
        }

        .login-heading {
            margin-bottom: 32px;
        }

        .login-heading h1 {
            margin: 0;

            color: #172b4d;

            font-size: 29px;
            font-weight: 750;

            letter-spacing: -0.5px;
        }

        .login-heading p {
            margin: 8px 0 0;

            color: #667085;

            font-size: 14px;
        }

        /* =========================================
           ALERT
           ========================================= */

        .login-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            padding: 13px 15px;

            margin-bottom: 20px;

            background: #fff1f2;

            border: 1px solid #fecdd3;

            border-radius: 10px;

            color: #b42318;

            font-size: 13px;
        }

        .login-alert i {
            margin-top: 1px;
        }

        .login-alert ul {
            margin: 0;
            padding-left: 17px;
        }

        .login-alert li {
            margin-bottom: 3px;
        }

        /* =========================================
           FORM
           ========================================= */

        .login-field {
            margin-bottom: 20px;
        }

        .login-label {
            display: block;

            margin-bottom: 8px;

            color: #344054;

            font-size: 13px;
            font-weight: 650;
        }

        .login-input-wrapper {
            position: relative;
        }

        .login-input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: #98a2b3;

            font-size: 17px;

            pointer-events: none;
        }

        .login-input {
            width: 100%;
            height: 50px;

            padding:
                0 15px 0 45px;

            border: 1px solid #d9dee8;

            border-radius: 11px;

            background: #ffffff;

            color: #344054;

            font-size: 14px;

            outline: none;

            transition: 0.2s ease;
        }

        .login-input::placeholder {
            color: #98a2b3;
        }

        .login-input:focus {
            border-color: #c8102e;

            box-shadow:
                0 0 0 3px rgba(200, 16, 46, 0.08);
        }

        /* =========================================
           PASSWORD
           ========================================= */

        .password-input {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;

            right: 5px;
            top: 5px;

            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;

            background: transparent;

            color: #98a2b3;

            border-radius: 8px;

            cursor: pointer;

            font-size: 17px;
        }

        .password-toggle:hover {
            color: #c8102e;
            background: #fff5f6;
        }

        /* =========================================
           OPTIONS
           ========================================= */

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin: 5px 0 25px;
        }

        .remember-option {
            display: flex;
            align-items: center;
            gap: 8px;

            color: #667085;

            font-size: 13px;

            cursor: pointer;
        }

        .remember-option input {
            width: 16px;
            height: 16px;

            accent-color: #c8102e;

            cursor: pointer;
        }

        .forgot-link {
            color: #c8102e;

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;
        }

        .forgot-link:hover {
            color: #9e0d25;
            text-decoration: underline;
        }

        /* =========================================
           LOGIN BUTTON
           ========================================= */

        .login-button {
            width: 100%;
            height: 51px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            border: none;
            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #c8102e,
                    #a30d25
                );

            color: #ffffff;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 18px rgba(200, 16, 46, 0.20);

            transition: 0.2s ease;
        }

        .login-button:hover {
            transform: translateY(-1px);

            box-shadow:
                0 11px 24px rgba(200, 16, 46, 0.28);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* =========================================
           SECURITY NOTE
           ========================================= */

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            margin-top: 25px;

            color: #98a2b3;

            font-size: 11px;
            text-align: center;
        }

        .security-note i {
            color: #039855;
            font-size: 13px;
        }

        /* =========================================
           FOOTER
           ========================================= */

        .login-footer {
            margin-top: 32px;

            padding-top: 20px;

            border-top: 1px solid #eaecf0;

            text-align: center;

            color: #98a2b3;

            font-size: 11px;
        }

        /* =========================================
           RESPONSIVE
           ========================================= */

        @media (max-width: 900px) {

            .admin-login-container {
                max-width: 650px;
                grid-template-columns: 1fr;
            }

            .login-brand {
                min-height: 330px;
                padding: 40px;
            }

            .brand-features {
                display: none;
            }

            .brand-title {
                font-size: 28px;
            }

            .login-form-section {
                padding: 45px 35px;
            }
        }

        @media (max-width: 550px) {

            .admin-login-page {
                padding: 15px;
            }

            .admin-login-container {
                border-radius: 18px;
            }

            .login-brand {
                padding: 35px 25px;
                min-height: 280px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;

                font-size: 27px;

                border-radius: 16px;

                margin-bottom: 20px;
            }

            .brand-title {
                font-size: 24px;
            }

            .brand-subtitle {
                font-size: 13px;
            }

            .login-form-section {
                padding: 35px 22px;
            }

            .login-heading h1 {
                font-size: 25px;
            }

            .login-options {
                align-items: flex-start;
                flex-direction: column;
            }

            .forgot-link {
                align-self: flex-end;
            }
        }

    </style>
</head>


<body>

<div class="admin-login-page">

    <div class="admin-login-container">

        {{-- =================================================
             LEFT BRANDING
             ================================================= --}}
        <section class="login-brand">

            <div class="brand-content">

                <div class="brand-logo">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <h2 class="brand-title">
                    COMMUNITY<br>
                    BLOOD DONOR
                </h2>

                <p class="brand-subtitle">
                    Admin management portal for coordinating
                    blood donors, requests, appointments,
                    and donation centers.
                </p>


                <div class="brand-features">

                    <div class="brand-feature">

                        <div class="brand-feature-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <span>
                            Manage users and donors
                        </span>

                    </div>


                    <div class="brand-feature">

                        <div class="brand-feature-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>

                        <span>
                            Monitor blood requests
                        </span>

                    </div>


                    <div class="brand-feature">

                        <div class="brand-feature-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>

                        <span>
                            Manage appointments
                        </span>

                    </div>


                    <div class="brand-feature">

                        <div class="brand-feature-icon">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>

                        <span>
                            View system statistics
                        </span>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             LOGIN FORM
             ================================================= --}}
        <section class="login-form-section">

            <div class="login-form-container">


                {{-- HEADER --}}
                <div class="login-heading">

                    <h1>
                        Welcome back, Admin
                    </h1>

                    <p>
                        Sign in to access your administration panel.
                    </p>

                </div>


                {{-- ERRORS --}}
                @if ($errors->any())

                    <div class="login-alert">

                        <i class="bi bi-exclamation-circle-fill"></i>

                        <div>

                            <strong>
                                Login failed
                            </strong>

                            <ul>

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endif


                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))

                    <div
                        class="login-alert"
                        style="
                            background:#ecfdf3;
                            border-color:#a6f4c5;
                            color:#027a48;
                        "
                    >

                        <i class="bi bi-check-circle-fill"></i>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                @endif


                {{-- LOGIN FORM --}}
                <form
                    method="POST"
                    action="{{ route('admin.login.submit') }}"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div class="login-field">

                        <label
                            for="email"
                            class="login-label"
                        >
                            Email Address
                        </label>

                        <div class="login-input-wrapper">

                            <i
                                class="bi bi-envelope login-input-icon"
                            ></i>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="login-input"
                                value="{{ old('email') }}"
                                placeholder="Enter your admin email"
                                autocomplete="email"
                                required
                                autofocus
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}
                    <div class="login-field">

                        <label
                            for="password"
                            class="login-label"
                        >
                            Password
                        </label>

                        <div class="login-input-wrapper">

                            <i
                                class="bi bi-lock login-input-icon"
                            ></i>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="login-input password-input"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                id="passwordToggle"
                                aria-label="Show password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>

                        </div>

                    </div>


                    {{-- OPTIONS --}}
                    <div class="login-options">

                        <label class="remember-option">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                            >

                            <span>
                                Remember me
                            </span>

                        </label>


                        <a
                            href="#"
                            class="forgot-link"
                            onclick="alert('Please contact the system administrator to reset your password.'); return false;"
                        >
                            Forgot password?
                        </a>

                    </div>


                    {{-- LOGIN BUTTON --}}
                    <button
                        type="submit"
                        class="login-button"
                    >

                        <i class="bi bi-box-arrow-in-right"></i>

                        <span>
                            Sign In to Admin Panel
                        </span>

                    </button>

                </form>


                {{-- SECURITY --}}
                <div class="security-note">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Secure administrator access
                    </span>

                </div>


                {{-- FOOTER --}}
                <div class="login-footer">

                    © {{ date('Y') }} Community Blood Donor.
                    Admin Portal.

                </div>

            </div>

        </section>

    </div>

</div>


{{-- =========================================================
     PASSWORD SHOW / HIDE
     ========================================================= --}}
<script>

    const passwordInput =
        document.getElementById('password');

    const passwordToggle =
        document.getElementById('passwordToggle');


    passwordToggle.addEventListener('click', function () {

        const isPassword =
            passwordInput.type === 'password';


        passwordInput.type =
            isPassword ? 'text' : 'password';


        const icon =
            this.querySelector('i');


        if (isPassword) {

            icon.classList.remove('bi-eye');

            icon.classList.add('bi-eye-slash');

            this.setAttribute(
                'aria-label',
                'Hide password'
            );

        } else {

            icon.classList.remove('bi-eye-slash');

            icon.classList.add('bi-eye');

            this.setAttribute(
                'aria-label',
                'Show password'
            );

        }

    });

</script>

</body>
</html>