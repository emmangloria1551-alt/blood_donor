<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - Community Blood Donor</title>

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
            background: #f5f7fb;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            color: #10264a;
        }

        .forgot-wrapper {
            width: 100%;
            max-width: 650px;
        }

        .forgot-card {
            background: #ffffff;
            border-radius: 22px;
            padding: 45px 55px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .logo {
            width: 88px;
            height: 88px;
            margin: 0 auto 25px;
            background: #cf0a2c;
            color: white;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 34px;
            font-weight: 700;
        }

        .description {
            color: #64748b;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .alert {
            padding: 15px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: left;
            font-size: 14px;
        }

        .alert-success {
            background: #ecfdf3;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
        }

        .field {
            text-align: left;
            margin-bottom: 22px;
        }

        .field label {
            display: block;
            margin-bottom: 9px;
            font-size: 15px;
            font-weight: 700;
            color: #10264a;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 17px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 20px;
        }

        .input-wrapper input {
            width: 100%;
            height: 58px;
            border: 1px solid #d7dee9;
            border-radius: 12px;
            padding: 0 18px 0 50px;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        .input-wrapper input:focus {
            border-color: #cf0a2c;
            box-shadow: 0 0 0 3px rgba(207, 10, 44, 0.08);
        }

        .error-text {
            color: #dc2626;
            font-size: 13px;
            margin-top: 7px;
        }

        .submit-btn {
            width: 100%;
            height: 58px;
            border: none;
            border-radius: 12px;
            background: #cf0a2c;
            color: white;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .submit-btn:hover {
            background: #b30928;
            transform: translateY(-1px);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            color: #cf0a2c;
            text-decoration: none;
            font-weight: 700;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 30px;
            color: #94a3b8;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .forgot-card {
                padding: 35px 25px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div class="forgot-wrapper">

    <div class="forgot-card">

        <div class="logo">
            <i class="bi bi-droplet-fill"></i>
        </div>

        <h1>Forgot Password?</h1>

        <p class="description">
            Enter your administrator email address and we'll send you
            a secure link to reset your password.
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Please fix the following:</strong>

                <ul style="margin: 8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.password.email') }}"
        >

            @csrf

            <div class="field">

                <label for="email">
                    Administrator Email
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your admin email"
                        required
                        autofocus
                    >

                </div>

            </div>

            <button
                type="submit"
                class="submit-btn"
            >
                <i class="bi bi-envelope"></i>
                Send Reset Link
            </button>

        </form>

        <a
            href="{{ route('admin.login') }}"
            class="back-link"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Login
        </a>

    </div>

    <div class="footer">
        © {{ date('Y') }} Community Blood Donor
    </div>

</div>

</body>
</html>