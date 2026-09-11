<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Dashboard') | Community Blood Donor</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f6f7fb;
            color: #212529;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 255px;
            height: 100vh;

            background: linear-gradient(
                180deg,
                #8f0d18 0%,
                #650812 100%
            );

            color: white;
            z-index: 1000;

            overflow-y: auto;

            box-shadow: 5px 0 20px rgba(0,0,0,0.08);
        }

        /* =========================
           LOGO
        ========================= */

        .logo-area {
            padding: 25px 20px;

            display: flex;
            align-items: center;
            gap: 13px;

            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .logo-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: white;
            color: #a30f1c;

            border-radius: 12px;

            font-size: 23px;

            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .logo-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .logo-subtitle {
            font-size: 11px;
            opacity: .7;
            margin-top: 2px;
        }

        /* =========================
           MENU
        ========================= */

        .menu-title {
            font-size: 10px;
            font-weight: 700;

            letter-spacing: 1.5px;

            color: rgba(255,255,255,.5);

            padding: 25px 20px 10px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;

            gap: 13px;

            margin: 5px 12px;

            padding: 12px 14px;

            color: rgba(255,255,255,.78);

            text-decoration: none;

            border-radius: 10px;

            font-size: 14px;

            transition: all .2s ease;
        }

        .sidebar-link i {
            font-size: 18px;
            width: 22px;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,.10);
            color: white;

            transform: translateX(3px);
        }

        .sidebar-link.active {
            background: white;
            color: #8f0d18;

            font-weight: 600;

            box-shadow: 0 5px 15px rgba(0,0,0,.12);
        }

        .sidebar-divider {
            height: 1px;

            background: rgba(255,255,255,.12);

            margin: 20px;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main-content {
            margin-left: 255px;

            min-height: 100vh;
        }

        /* =========================
           NAVBAR
        ========================= */

        .top-navbar {
            height: 75px;

            background: white;

            border-bottom: 1px solid #eee;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            position: sticky;
            top: 0;

            z-index: 999;
        }

        .search-box {
            width: 300px;

            background: #f7f7f9;

            border: 1px solid #eee;

            border-radius: 10px;

            padding: 9px 14px;

            display: flex;
            align-items: center;

            gap: 10px;
        }

        .search-box i {
            color: #999;
        }

        .search-box input {
            border: none;
            outline: none;

            background: transparent;

            width: 100%;

            font-size: 13px;
        }

        .admin-profile {
            display: flex;
            align-items: center;

            gap: 12px;

            cursor: pointer;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            background: #8f0d18;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 600;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 600;
        }

        .admin-role {
            font-size: 11px;
            color: #999;
        }

        /* =========================
           PAGE CONTENT
        ========================= */

        .page-content {
            padding: 30px;
        }

        .page-title {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #888;
            font-size: 13px;
            margin-bottom: 25px;
        }

        /* =========================
           CARDS
        ========================= */

        .dashboard-card {
            background: white;

            border-radius: 15px;

            padding: 22px;

            border: 1px solid #eee;

            box-shadow: 0 5px 20px rgba(0,0,0,.03);

            transition: all .2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);

            box-shadow: 0 10px 25px rgba(0,0,0,.07);
        }

        .stat-icon {
            width: 50px;
            height: 50px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 22px;
        }

        .stat-number {
            font-size: 27px;
            font-weight: 700;

            margin-top: 12px;
        }

        .stat-label {
            color: #888;
            font-size: 13px;
        }

        /* =========================
           CONTENT CARD
        ========================= */

        .content-card {
            background: white;

            border: 1px solid #eee;

            border-radius: 15px;

            padding: 25px;

            box-shadow: 0 5px 20px rgba(0,0,0,.03);
        }

        .content-card-title {
            font-size: 16px;
            font-weight: 700;

            margin-bottom: 20px;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 600;
        }

        .status-success {
            background: #e8f8ee;
            color: #198754;
        }

        .status-warning {
            background: #fff4d6;
            color: #b58105;
        }

        .status-danger {
            background: #fde8e8;
            color: #c62828;
        }

        /* =========================
           TABLE
        ========================= */

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table th {
            color: #888;

            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: .5px;

            padding: 12px;

            border-bottom: 1px solid #eee;
        }

        .modern-table td {
            padding: 15px 12px;

            font-size: 13px;

            border-bottom: 1px solid #f1f1f1;
        }

        .modern-table tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           BUTTONS
        ========================= */

        .btn-blood {
            background: #8f0d18;

            color: white;

            border: none;

            border-radius: 9px;

            padding: 9px 16px;

            font-size: 13px;

            transition: .2s;
        }

        .btn-blood:hover {
            background: #700812;
            color: white;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 768px) {

            .sidebar {
                width: 220px;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .top-navbar {
                padding: 0 15px;
            }

            .search-box {
                display: none;
            }

            .page-content {
                padding: 20px 15px;
            }

        }

    </style>
</head>

<body>

    @include('admin.layouts.sidebar')

    <div class="main-content">

        @include('admin.layouts.navbar')

        <main class="page-content">

            @yield('content')

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>