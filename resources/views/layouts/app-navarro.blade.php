<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Lotlot Event Booking')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>

      .btn-outline {
            background: transparent;
            color: #6b7280;
            border: 1.5px solid #e5e7eb;
            box-shadow: none;
        }
        .btn-outline:hover {
            background: #f9fafb;
            color: #374151;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px -6px rgba(0,0,0,0.1);
        }
        .btn-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at 10% 10%, #1e3a8a 0%, transparent 40%),
                        radial-gradient(circle at 90% 90%, #7c3aed 0%, transparent 40%),
                        linear-gradient(135deg, #0f172a, #1e1b4b 60%, #312e81);
            background-attachment: fixed;
            color: #1f2937;
            padding: 40px 16px;
        }
        .page-wrap { max-width: 680px; margin: 0 auto; }
        .brand { text-align: center; color: #fff; margin-bottom: 28px; }
        .brand .logo { display: inline-flex; align-items: center; gap: 10px; font-weight: 800; font-size: 22px; letter-spacing: -0.5px; }
        .brand .logo span.dot { width: 10px; height: 10px; border-radius: 50%; background: linear-gradient(135deg, #38bdf8, #a78bfa); display: inline-block; }
        .brand p { margin: 6px 0 0; font-size: 13px; color: rgba(255,255,255,0.6); letter-spacing: 1px; text-transform: uppercase; }
        .stepper { display: flex; justify-content: space-between; margin-bottom: 28px; position: relative; }
        .stepper::before { content: ''; position: absolute; top: 14px; left: 28px; right: 28px; height: 2px; background: rgba(255,255,255,0.15); z-index: 0; }
        .step { position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; gap: 6px; flex: 1; }
        .step .circle { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; background: rgba(255,255,255,0.1); border: 2px solid rgba(255,255,255,0.25); color: rgba(255,255,255,0.6); transition: all .3s ease; }
        .step.done .circle { background: linear-gradient(135deg, #22c55e, #16a34a); border-color: #22c55e; color: #fff; }
        .step.active .circle { background: linear-gradient(135deg, #38bdf8, #6366f1); border-color: #a5b4fc; color: #fff; box-shadow: 0 0 0 6px rgba(99,102,241,0.25); }
        .step span.label { font-size: 11.5px; color: rgba(255,255,255,0.55); font-weight: 600; }
        .step.active span.label, .step.done span.label { color: #fff; }
        .card { background: rgba(255,255,255,0.97); border-radius: 20px; padding: 40px; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.08) inset; backdrop-filter: blur(10px); }
        h1 { font-size: 26px; font-weight: 800; margin: 0 0 8px; background: linear-gradient(135deg, #4338ca, #7c3aed); -webkit-background-clip: text; background-clip: text; color: transparent; letter-spacing: -0.5px; }
        .subtitle { color: #6b7280; font-size: 14.5px; margin: 0 0 24px; }
        label { display: block; margin-top: 18px; margin-bottom: 7px; font-weight: 600; font-size: 13.5px; color: #374151; }
        input[type=text], input[type=number], input[type=file] { width: 100%; padding: 12px 14px; border: 1.5px solid #e5e7eb; border-radius: 10px; font-size: 14.5px; font-family: inherit; transition: border-color .2s, box-shadow .2s; background: #fafafa; }
        input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.15); background: #fff; }
        input[readonly] { background: #f3f4f6; color: #6b7280; }
        button, .btn { display: inline-flex; align-items: center; gap: 8px; margin-top: 26px; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: #fff; border: none; padding: 13px 24px; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; text-decoration: none; box-shadow: 0 8px 20px -6px rgba(79,70,229,0.5); transition: transform .15s ease, box-shadow .15s ease; }
        button:hover, .btn:hover { transform: translateY(-2px); box-shadow: 0 12px 24px -6px rgba(79,70,229,0.6); }
        .btn-secondary { background: linear-gradient(135deg, #6b7280, #4b5563); box-shadow: 0 8px 20px -6px rgba(75,85,99,0.4); }
        .alert { padding: 13px 16px; border-radius: 10px; margin-bottom: 18px; font-size: 14px; font-weight: 500; border: 1px solid transparent; }
        .alert-success { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }
        .alert-error { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        ul.error-list { margin: 4px 0 0 0; padding-left: 18px; }
        .field-error { color: #dc2626; font-size: 12.5px; margin-top: 5px; font-weight: 500; }
        .summary-row { display: flex; justify-content: space-between; padding: 13px 0; border-bottom: 1px solid #f1f1f4; font-size: 14.5px; }
        .summary-row span { color: #6b7280; }
        .summary-row strong { color: #1f2937; }
        img.preview { max-width: 100%; border-radius: 14px; margin-top: 14px; border: 1px solid #e5e7eb; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.2); }
        ol { color: #374151; font-size: 14.5px; line-height: 1.7; padding-left: 20px; }
        ol li strong { color: #1f2937; }
        p { line-height: 1.6; }
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="brand">
            <div class="logo"><span class="dot"></span> Lotlot Event Booking</div>
            <p>Reserve · Confirm · Done</p>
        </div>

        <div class="stepper">
            <div class="step @yield('step1class')"><div class="circle">1</div><span class="label">Start</span></div>
            <div class="step @yield('step2class')"><div class="circle">2</div><span class="label">Details</span></div>
            <div class="step @yield('step3class')"><div class="circle">3</div><span class="label">Confirm</span></div>
            <div class="step @yield('step4class')"><div class="circle">4</div><span class="label">Summary</span></div>
            <div class="step @yield('step5class')"><div class="circle">5</div><span class="label">My Bookings</span></div>
        </div>

        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    Please fix the following:
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>