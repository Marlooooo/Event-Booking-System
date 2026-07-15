<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin — Lotlot Event Booking')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            color: #1f2937;
        }

        /* ── Sidebar — exact copy from admin-navarro.blade.php ── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            flex-shrink: 0;
            background: linear-gradient(180deg, #1e1b4b, #312e81);
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar .brand {
            color: #fff;
            font-weight: 800;
            font-size: 17px;
            margin-bottom: 2px;
            letter-spacing: -0.3px;
            padding: 14px;
        }

        .sidebar .brand span {
            display: block;
            font-size: 11px;
            font-weight: 500;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: background .15s, color .15s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.12);
            color: #fff;
        }

        .sidebar .divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 12px 0;
        }

        .sidebar form button {
            width: 100%;
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.7);
            text-align: left;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s, color .15s;
        }

        .sidebar form button:hover {
            background: rgba(255,255,255,0.12);
            color: #fff;
        }

        /* ── Main area ── */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f4f6f8;
            overflow-x: hidden;
        }

        /* ── Top bar ── */
        .topbar {
            background: #fff;
            border-bottom: 1.5px solid #e2e8f0;
            padding: 0 36px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #94a3b8;
            font-weight: 600;
        }

        .topbar-breadcrumb .sep { color: #cbd5e1; }

        .topbar-breadcrumb .current { color: #0f172a; }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-user {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .topbar-role {
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── Page content ── */
        .page-content {
            flex: 1;
            padding: 36px;
        }

        /* ── Page header ── */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header-left .eyebrow {
            font-size: 11px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .page-header-left h1 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .page-header-left p {
            font-size: 13.5px;
            color: #94a3b8;
            margin: 5px 0 0;
            font-weight: 500;
        }

        /* ── Form card ── */
        .form-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e2e8f0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            overflow: hidden;
            max-width: 720px;
        }

        .form-card-header {
            padding: 20px 28px;
            border-bottom: 1.5px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-card-header .card-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: linear-gradient(135deg, #e0e7ff, #ede9fe);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .form-card-header .card-icon svg {
            width: 18px;
            height: 18px;
            stroke: #6366f1;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-card-header .card-title {
            font-size: 14.5px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.2px;
        }

        .form-card-header .card-subtitle {
            font-size: 12.5px;
            color: #94a3b8;
            font-weight: 500;
            margin-top: 1px;
        }

        .form-card-body {
            padding: 28px;
        }

        /* ── Form elements ── */
     
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .form-row.single {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 12.5px;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group .hint {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
            margin-top: -2px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            font-size: 14px;
            font-family: inherit;
            color: #1f2937;
            background: #f8fafc;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
            background: #fff;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #c4c9d4;
        }

        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-color: #f8fafc;
            padding-right: 36px;
            cursor: pointer;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            background: #f8fafc;
            cursor: pointer;
        }

        .checkbox-row input[type=checkbox] {
            width: 16px;
            height: 16px;
            accent-color: #6366f1;
            cursor: pointer;
            flex-shrink: 0;
        }

        .checkbox-row label {
            font-size: 13.5px;
            font-weight: 600;
            color: #374151;
            cursor: pointer;
            text-transform: none;
            letter-spacing: 0;
        }

        .field-error {
            font-size: 12px;
            color: #dc2626;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .field-error::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #dc2626;
            flex-shrink: 0;
        }

        /* ── Section divider ── */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 20px;
        }

        .section-divider span {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* ── Form footer ── */
        .form-card-footer {
            padding: 20px 28px;
            border-top: 1.5px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .form-card-footer .footer-left {
            font-size: 12.5px;
            color: #94a3b8;
            font-weight: 500;
        }

        .footer-actions {
            display: flex;
            gap: 10px;
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 9px;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            color: #374151;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-cancel:hover { background: #f8fafc; }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            border-radius: 9px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            font-size: 13.5px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 14px rgba(99,102,241,0.3);
            transition: transform .15s, box-shadow .15s;
            text-decoration: none;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(99,102,241,0.38);
        }

        .btn-submit:active { transform: translateY(0); }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 9px;
            border: 1.5px solid #fecaca;
            background: #fff;
            color: #dc2626;
            font-size: 13.5px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-danger:hover { background: #fef2f2; }

        /* ── Alerts ── */
        .alert {
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 600;
            border: 1px solid transparent;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }
        .alert-error   { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }

        .alert-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .alert-success .alert-dot { background: #16a34a; }
        .alert-error   .alert-dot { background: #dc2626; }

        .alert ul { margin: 4px 0 0; padding-left: 16px; }

        /* ── Table styles ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .data-table thead tr {
            border-bottom: 1.5px solid #e2e8f0;
            background: #f8fafc;
        }

        .data-table thead th {
            padding: 11px 16px;
            font-size: 10.5px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-align: left;
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background .1s;
        }

        .data-table tbody tr:hover { background: #fafbff; }
        .data-table tbody tr:last-child { border-bottom: none; }

        .data-table tbody td {
            padding: 13px 16px;
            color: #374151;
            vertical-align: middle;
        }

        .table-name { font-weight: 700; color: #0f172a; }
        .table-meta { font-size: 12px; color: #94a3b8; margin-top: 2px; }

        .badge-type {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-type.event { background: #ede9fe; color: #5b21b6; }
        .badge-type.room  { background: #e0f2fe; color: #0369a1; }

        .badge-active {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-active::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .badge-active.yes { color: #16a34a; }
        .badge-active.yes::before { background: #22c55e; }
        .badge-active.no  { color: #94a3b8; }
        .badge-active.no::before  { background: #cbd5e1; }

        .table-actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .tbl-btn {
            padding: 5px 13px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            color: #374151;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: background .15s;
        }

        .tbl-btn:hover { background: #f8fafc; }

        .tbl-btn.danger { border-color: #fecaca; color: #dc2626; }
        .tbl-btn.danger:hover { background: #fef2f2; }

        @media (max-width: 900px) {
            .form-row { grid-template-columns: 1fr; }
            .page-content { padding: 24px 20px; }
            .sidebar { display: none; }
        }
    </style>
</head>
<body>

    <!-- Sidebar — exact copy from admin-navarro.blade.php -->
    <div class="sidebar">
        <div class="brand">
            Lotlot Event
            <span>Admin Panel</span>
        </div>
        <a href="{{ route('admin.dashboard.navarro') }}" class="{{ request()->routeIs('admin.dashboard.navarro') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.bookings.navarro') }}" class="{{ request()->routeIs('admin.bookings.navarro') ? 'active' : '' }}">All Bookings</a>
        <a href="{{ route('admin.bookings.navarro', ['status' => 'pending']) }}">Pending</a>
        <a href="{{ route('admin.bookings.navarro', ['status' => 'accepted']) }}">Accepted</a>
        <a href="{{ route('admin.bookings.navarro', ['status' => 'rejected']) }}">Rejected</a>
        <hr class="divider">
        <a href="{{ route('events-rooms.index') }}" class="{{ request()->routeIs('events-rooms.*') ? 'active' : '' }}">Venues</a>
        <hr class="divider">
        <form method="POST" action="{{ route('logout.navarro') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>
    </div>

    <!-- Main area -->
    <div class="main-area">

        <!-- Top bar -->
        <div class="topbar">
            <div class="topbar-breadcrumb">
                <a href="{{ route('admin.dashboard.navarro') }}" style="color:#94a3b8;text-decoration:none;font-weight:600;">Dashboard</a>
                <span class="sep">/</span>
                @hasSection('breadcrumb-parent')
                    @yield('breadcrumb-parent')
                    <span class="sep">/</span>
                @endif
                <span class="current">@yield('breadcrumb-current', 'Page')</span>
            </div>
            <div class="topbar-right">
                <span class="topbar-user">{{ auth()->user()->name }}</span>
                <span class="topbar-role">Admin</span>
            </div>
        </div>

        <!-- Content -->
        <div class="page-content">

            @if (session('success'))
                <div class="alert alert-success">
                    <span class="alert-dot"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <span class="alert-dot"></span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <span class="alert-dot"></span>
                    <div>
                        Please fix the following errors:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')

        </div>
    </div>

</body>
</html>