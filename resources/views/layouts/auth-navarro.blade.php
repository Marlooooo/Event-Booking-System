<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Lotlot Event Booking')</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{
font-family:'Plus Jakarta Sans',sans-serif;
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
background:linear-gradient(135deg,#312e81,#4f46e5,#7c3aed);
overflow:hidden;
}
body:before{
content:"";
position:fixed;
width:500px;height:500px;
background:rgba(255,255,255,.08);
border-radius:50%;
top:-150px;left:-120px;
filter:blur(10px);
}
body:after{
content:"";
position:fixed;
width:600px;height:600px;
background:rgba(255,255,255,.06);
border-radius:50%;
right:-180px;bottom:-180px;
filter:blur(10px);
}
.wrapper{
position:relative;
z-index:10;
width:min(1100px,95%);
display:grid;
grid-template-columns:1fr 470px;
background:#fff;
border-radius:24px;
overflow:hidden;
box-shadow:0 30px 80px rgba(0,0,0,.25);
}
.hero{
padding:70px 60px;
background:linear-gradient(160deg,#312e81,#4338ca,#6d28d9);
color:#fff;
display:flex;
flex-direction:column;
justify-content:center;
}
.logo{
font-size:32px;
font-weight:800;
margin-bottom:20px;
}
.hero h1{
font-size:42px;
line-height:1.2;
margin-bottom:18px;
}
.hero p{
font-size:16px;
opacity:.9;
line-height:1.7;
margin-bottom:30px;
}
.features{
display:grid;
gap:14px;
}
.feature{
background:rgba(255,255,255,.12);
padding:14px 18px;
border-radius:12px;
backdrop-filter:blur(8px);
}
.form-side{
padding:60px 50px;
display:flex;
align-items:center;
}
.form-box{width:100%}
h2{
font-size:30px;
margin-bottom:10px;
color:#111827;
}
.subtitle{
color:#6b7280;
margin-bottom:28px;
}
label{
display:block;
margin:18px 0 8px;
font-weight:600;
font-size:14px;
}
input{
width:100%;
padding:14px 16px;
border:1px solid #d1d5db;
border-radius:12px;
font-size:15px;
transition:.2s;
}
input:focus{
outline:none;
border-color:#4f46e5;
box-shadow:0 0 0 4px rgba(79,70,229,.15);
}
button{
margin-top:24px;
width:100%;
padding:15px;
border:none;
border-radius:12px;
background:linear-gradient(135deg,#4338ca,#7c3aed);
color:#fff;
font-size:16px;
font-weight:700;
cursor:pointer;
transition:.2s;
}
button:hover{
transform:translateY(-2px);
box-shadow:0 15px 30px rgba(79,70,229,.25);
}
.field-error{color:#dc2626;font-size:13px;margin-top:5px}
.footer{
margin-top:22px;
text-align:center;
font-size:14px;
color:#6b7280;
}
.footer a{
color:#4f46e5;
text-decoration:none;
font-weight:700;
}
@media(max-width:900px){
.wrapper{grid-template-columns:1fr}
.hero{display:none}
.form-side{padding:40px 30px}
}
</style>
</head>
<body>
<div class="wrapper">
<div class="hero">
<div class="logo">🎉 Lotlot Event Booking</div>
<h1>Book events with confidence.</h1>
<p>Manage reservations, monitor bookings, and organize events from one modern platform.</p>
<div class="features">
<div class="feature">✓ Secure account authentication</div>
<div class="feature">✓ Live booking calendar</div>
<div class="feature">✓ Fast reservation workflow</div>
<div class="feature">✓ Professional event management</div>
</div>
</div>

<div class="form-side">
<div class="form-box">
@yield('content')
</div>
</div>
</div>
</body>
</html>
