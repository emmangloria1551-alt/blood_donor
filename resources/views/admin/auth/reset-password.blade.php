<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - Community Blood Donor</title>

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

        .reset-wrapper {
            width: 100%;
            max-width: 650px;
        }

        .reset-card {
            background: #ffffff;
            border-radius: 22px;
            padding: 45px 55px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
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
            text-align: center;
            margin: 0 0 10px;
            font-size: 34px;
        }

        .description {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
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
            font-size: 19px;
        }

        .input-wrapper input {
            width: 100%;
            height: 56px;
            border: 1px solid #d7dee9;
            border-radius: 12px;
            padding: 0 18px 0 50px;
            font-size: 16px;
            outline: none;
        }

        .input-wrapper input:focus {
            border-color: #cf0a2c;
            box-shadow: 0 0 0 3px rgba(207, 10, 44, 0.08);
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .reset-btn {
            width: 100%;
            height: 58px;
            margin-top: 10px;
            border: none;
            border-radius: 12px;
            background: #cf0a2c;
            color: white;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
        }

        .reset-btn:hover {
            background: #b30928;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            color: #cf0a2c;
            text-decoration: none;
            font-weight: 700;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            margin-top: 25px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .reset-card {
                padding: 35px 25px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div class="reset-wrapper">

    <div class="reset-card">

        <div class="logo">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <h1>Reset Password</h1>

        <p class="description">
            Create a new password for your administrator account.
        </p>

        @if($errors->any())
            <div
                style="
                    background:#fff1f2;
                    color:#be123c;
                    border:1px solid #fecdd3;
                    padding:15px;
                    border-radius:12px;
                    margin-bottom:20px;
                "
            >
                <strong>Please fix the following:</strong>

                <ul style="margin:8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('password.update') }}"
        >

            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >

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
                        value="{{ old('email', $email) }}"
                        required
                    >

                </div>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="field">

                <label for="password">
                    New Password
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter new password"
                        required
                    >

                </div>

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="field">

                <label for="password_confirmation">
                    Confirm New Password
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-lock-fill"></i>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm new password"
                        required
                    >

                </div>

            </div>

            <button
                type="submit"
                class="reset-btn"
            >
                <i class="bi bi-check-circle"></i>
                Reset Password
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