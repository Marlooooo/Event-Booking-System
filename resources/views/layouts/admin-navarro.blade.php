<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Lotlot Event Booking')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin:0; font-family:'Plus Jakarta Sans',sans-serif; background:#0f172a; color:#1f2937; display:flex; min-height:100vh; }
        .sidebar {
            width: 240px; min-height:100vh; flex-shrink:0;
            background: linear-gradient(180deg, #1e1b4b, #312e81);
            padding: 28px 20px;
            display: flex; flex-direction: column; gap: 6px;
        }
        .sidebar .brand { color:#fff; font-weight:800; font-size:17px; margin-bottom:2px; letter-spacing:-0.3px; padding: 14px;}
        .sidebar .brand span { display:block; font-size:11px; font-weight:500; color:rgba(255,255,255,0.5); margin-top:2px; text-transform:uppercase; letter-spacing:1px; }
        .sidebar a {
            display:block; color:rgba(255,255,255,0.7); text-decoration:none;
            padding:10px 14px; border-radius:8px; font-size:14px; font-weight:500;
            transition: background .15s, color .15s;
        }
        .sidebar a:hover, .sidebar a.active { background:rgba(255,255,255,0.12); color:#fff; }
        .sidebar .divider { border:none; border-top:1px solid rgba(255,255,255,0.1); margin:12px 0; }
        .sidebar form button {
            width:100%; background:transparent; border:none; color:rgba(255,255,255,0.7);
            text-align:left; padding:10px 14px; border-radius:8px; font-size:14px; font-weight:500;
            cursor:pointer; font-family:inherit; transition: background .15s, color .15s;
        }
        .sidebar form button:hover { background:rgba(255,255,255,0.12); color:#fff; }
        .main { flex:1; padding:40px; overflow-y:auto; background:#f4f6f8; }
        .card { background:#fff; border-radius:16px; padding:32px; box-shadow:0 4px 20px rgba(0,0,0,0.06); }
        h1 { font-size:24px; font-weight:800; margin:0 0 6px; background:linear-gradient(135deg,#4338ca,#7c3aed); -webkit-background-clip:text; background-clip:text; color:transparent; }
        .subtitle { color:#6b7280; font-size:14px; margin:0 0 20px; }
        .stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:14px; margin:20px 0; }
        .stat-card { background:#fff; border-radius:14px; padding:20px; text-align:center; box-shadow:0 2px 10px rgba(0,0,0,0.05); border-left:4px solid #6366f1; }
        .stat-card.pending { border-color:#f59e0b; }
        .stat-card.accepted { border-color:#22c55e; }
        .stat-card.rejected { border-color:#ef4444; }
        .stat-number { font-size:32px; font-weight:800; color:#1f2937; }
        .stat-label { font-size:12px; color:#6b7280; font-weight:600; margin-top:4px; text-transform:uppercase; letter-spacing:0.5px; }
        .booking-row { background:#fff; border-radius:12px; padding:16px 18px; margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; box-shadow:0 2px 8px rgba(0,0,0,0.04); }
        .booking-row strong { display:block; font-size:14.5px; color:#1f2937; }
        .booking-row .meta { font-size:12.5px; color:#9ca3af; margin-top:2px; display:block; }
        .badge { padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; }
        .btn-sm { padding:6px 14px; border-radius:7px; background:#f1f5f9; color:#374151; border:none; font-size:13px; font-weight:600; cursor:pointer; text-decoration:none; font-family:inherit; transition:background .15s; }
        .btn-sm:hover { background:#e2e8f0; }
        .btn-sm.accept { background:#dcfce7; color:#166534; }
        .btn-sm.accept:hover { background:#bbf7d0; }
        .btn-sm.reject { background:#fee2e2; color:#991b1b; }
        .btn-sm.reject:hover { background:#fecaca; }
        .btn { display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff; border:none; padding:11px 20px; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer; text-decoration:none; font-family:inherit; }
        .btn-outline { background:transparent; color:#6b7280; border:1.5px solid #e5e7eb; box-shadow:none; }
        .btn-outline:hover, .btn-outline.active-filter { background:#f9fafb; color:#374151; }
        .btn-row { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        .alert { padding:12px 16px; border-radius:10px; margin-bottom:16px; font-size:14px; font-weight:500; }
        .alert-success { background:#ecfdf5; color:#047857; border:1px solid #a7f3d0; }
        .alert-error { background:#fef2f2; color:#b91c1c; border:1px solid #fecaca; }
        .summary-row { display:flex; justify-content:space-between; padding:12px 0; border-bottom:1px solid #f1f1f4; font-size:14px; }
        .summary-row span { color:#6b7280; }
        img.preview { max-width:100%; border-radius:12px; margin-top:14px; }
        label { display:block; margin-top:16px; margin-bottom:6px; font-weight:600; font-size:13.5px; color:#374151; }
        input { width:100%; padding:11px 13px; border:1.5px solid #e5e7eb; border-radius:9px; font-size:14px; font-family:inherit; }
        input:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,0.15); }
        .field-error { color:#dc2626; font-size:12.5px; margin-top:4px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            Lotlot Event
            <span>Admin Panel</span>
        </div>
       <a href="{{ route('admin.dashboard.navarro') }}"
   class="{{ request()->routeIs('admin.dashboard.navarro') ? 'active' : '' }}">
    Dashboard
</a>

<a href="{{ route('admin.bookings.navarro') }}"
   class="{{ request()->routeIs('admin.bookings.navarro') && !request('status') ? 'active' : '' }}">
    All Bookings
</a>

<a href="{{ route('admin.bookings.navarro', ['status' => 'pending']) }}"
   class="{{ request('status') == 'pending' ? 'active' : '' }}">
    Pending
</a>

<a href="{{ route('admin.bookings.navarro', ['status' => 'accepted']) }}"
   class="{{ request('status') == 'accepted' ? 'active' : '' }}">
    Accepted
</a>

<a href="{{ route('admin.bookings.navarro', ['status' => 'rejected']) }}"
   class="{{ request('status') == 'rejected' ? 'active' : '' }}">
    Rejected
</a>

<hr class="divider">

<a href="{{ route('events-rooms.index') }}"
   class="{{ request()->routeIs('events-rooms.*') ? 'active' : '' }}">
    Venues
</a>
        <hr class="divider">
        <form method="POST" action="{{ route('logout.navarro') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>
    </div>

    <div class="main">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="card">
            @yield('content')
        </div>
    </div>
</body>
</html>