<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Lotlot Event Booking')</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Plus Jakarta Sans',sans-serif;min-height:100vh;color:#fff;background:radial-gradient(circle at top left,#5b21b6 0%,transparent 35%),radial-gradient(circle at bottom right,#4338ca 0%,transparent 35%),linear-gradient(135deg,#1e1b4b,#312e81,#4f46e5);padding:40px}
.container{max-width:900px;margin:auto}
.card{background:rgba(255,255,255,.1);backdrop-filter:blur(18px);border:1px solid rgba(255,255,255,.12);border-radius:24px;padding:40px;box-shadow:0 25px 60px rgba(0,0,0,.35)}
h1{font-size:34px;margin-bottom:10px}
label{display:block;margin:18px 0 8px;font-weight:600}
input,select{width:100%;padding:14px 16px;border-radius:12px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.08);color:#fff}
input:focus,select:focus{outline:none;border-color:#8b5cf6}
button{margin-top:24px;padding:14px 26px;border:none;border-radius:12px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;font-weight:700;cursor:pointer}
.field-error{color:#fecaca;margin-top:6px;font-size:13px}

</style>
</head>
<body>
<div class="container">
<div class="card">
@yield('content')
</div>
</div>
</body>
</html>