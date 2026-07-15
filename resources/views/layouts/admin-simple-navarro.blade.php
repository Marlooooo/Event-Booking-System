<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Lotlot Event Booking')</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box}

body{
    font-family:'Plus Jakarta Sans',sans-serif;
    color:#f4f4fb;
    min-height:100vh;
    background:
        radial-gradient(900px 500px at 0% 0%,rgba(139,92,246,.28),transparent 60%),
        radial-gradient(900px 500px at 100% 100%,rgba(67,56,202,.28),transparent 60%),
        linear-gradient(135deg,#0f0d2e,#1a1748,#2a2270);
    background-attachment:fixed;
    -webkit-font-smoothing:antialiased;
    letter-spacing:-.005em;
}

/*=============================
TOP BAR
=============================*/
.topbar{
    width:100%;
    height:72px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 40px;
    position:sticky;
    top:0;
    backdrop-filter:saturate(140%) blur(20px);
    background:rgba(15,13,46,.55);
    border-bottom:1px solid rgba(255,255,255,.08);
    z-index:999;
}

.logo{
    display:flex;
    align-items:center;
    gap:12px;
    font-size:20px;
    font-weight:800;
    letter-spacing:-.01em;
}
.logo span{color:#fff}

.nav{
    display:flex;
    align-items:center;
    gap:4px;
    padding:6px;
    border-radius:14px;
    background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.08);
}
.nav a{
    text-decoration:none;
    color:rgba(244,244,251,.65);
    font-weight:600;
    font-size:14px;
    padding:9px 16px;
    border-radius:10px;
    transition:.2s ease;
}
.nav a:hover{
    background:rgba(255,255,255,.09);
    color:#fff;
}
.nav a.active{
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    color:#fff;
    box-shadow:0 14px 32px -12px rgba(124,58,237,.5);
}

/*=============================
PAGE
=============================*/
.page{
    max-width:1200px;
    margin:40px auto;
    padding:0 30px;
}

/*=============================
MAIN CARD
=============================*/
.card{
    background:rgba(255,255,255,.05);
    backdrop-filter:blur(16px);
    border:1px solid rgba(255,255,255,.10);
    border-radius:22px;
    padding:36px;
    box-shadow:0 30px 70px -20px rgba(0,0,0,.5);
}

h1{
    font-size:32px;
    margin-bottom:8px;
    font-weight:800;
    letter-spacing:-.02em;
}
.subtitle{
    color:rgba(244,244,251,.62);
    margin-bottom:28px;
    font-size:14px;
}

/*=============================
BUTTONS
=============================*/
.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:11px 20px;
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
    font-size:14px;
    color:#fff;
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    box-shadow:0 14px 32px -12px rgba(124,58,237,.5);
    transition:.2s ease;
    border:none;
    cursor:pointer;
}
.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 38px -12px rgba(124,58,237,.6);
}

.btn-outline{
    background:rgba(255,255,255,.06);
    color:#fff;
    border:1px solid rgba(255,255,255,.14);
    box-shadow:none;
    padding:9px 16px;
    font-size:13px;
}
.btn-outline:hover{
    background:rgba(255,255,255,.12);
    box-shadow:none;
}

.btn-secondary{
    border:none;
    padding:9px 16px;
    border-radius:11px;
    cursor:pointer;
    color:#fff;
    font-weight:700;
    font-size:13px;
    background:linear-gradient(135deg,#ef4444,#dc2626);
    box-shadow:0 12px 28px -10px rgba(239,68,68,.45);
    transition:.2s ease;
    font-family:inherit;
}
.btn-secondary:hover{
    transform:translateY(-2px);
}

/*=============================
ROWS
=============================*/
.summary-row{
    margin-top:12px;
    padding:18px 22px;
    border-radius:14px;
    background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;
    transition:.2s ease;
}
.summary-row:hover{
    transform:translateY(-2px);
    background:rgba(255,255,255,.09);
    border-color:rgba(255,255,255,.14);
}
.summary-row span:first-child{
    font-size:15px;
    font-weight:700;
    letter-spacing:-.005em;
}

.btn-row{
    display:flex;
    gap:8px;
    align-items:center;
}

/*=============================
ALERTS
=============================*/
.alert-success{
    padding:14px 18px;
    border-radius:12px;
    margin-bottom:22px;
    color:#bbf7d0;
    background:rgba(34,197,94,.14);
    border:1px solid rgba(34,197,94,.28);
    font-size:14px;
}
.alert-error{
    padding:14px 18px;
    border-radius:12px;
    margin-bottom:22px;
    color:#fecaca;
    background:rgba(239,68,68,.14);
    border:1px solid rgba(239,68,68,.28);
    font-size:14px;
}

/*=============================
RESPONSIVE
=============================*/
@media(max-width:900px){
    .topbar{
        flex-direction:column;
        height:auto;
        gap:14px;
        padding:18px 20px;
    }
    .nav{flex-wrap:wrap;justify-content:center}
    .summary-row{
        flex-direction:column;
        align-items:flex-start;
        gap:14px;
    }
    .btn-row{flex-wrap:wrap;width:100%}
    .page{padding:20px}
    .card{padding:24px;border-radius:18px}
    h1{font-size:26px}
}
</style>
</head>
<body>

<header class="topbar">
    <div class="logo">🎉 <span>Lotlot Event Booking</span></div>
<nav class="nav">
    <a href="{{ route('admin.dashboard.navarro') }}"
       class="{{ request()->routeIs('admin.dashboard.navarro') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('admin.bookings.navarro') }}"
       class="{{ request()->routeIs('admin.bookings.navarro') ? 'active' : '' }}">
        Bookings
    </a>

    <a href="{{ route('events-rooms.index') }}"
       class="{{ request()->routeIs('events-rooms.*') ? 'active' : '' }}">
        Events &amp; Rooms
    </a>
</nav>
</header>

<div class="page">

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')

</div>

</body>
</html>
