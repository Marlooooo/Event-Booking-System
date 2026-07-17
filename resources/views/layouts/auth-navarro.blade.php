<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lotlot Event Booking')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            color: #1f2937;
        }

        /* ── Left panel ── */
        .auth-left {
            width: 48%;
            flex-shrink: 0;
            background:
                radial-gradient(circle at 15% 20%, rgba(99,102,241,0.4) 0%, transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(124,58,237,0.4) 0%, transparent 45%),
                linear-gradient(160deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 56px;
            position: relative;
            overflow: hidden;
        }

        .auth-left .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(165,180,252,0.12);
        }

        .auth-left .ring-1 { width: 380px; height: 380px; top: -120px; left: -120px; }
        .auth-left .ring-2 { width: 260px; height: 260px; bottom: -80px; right: -60px; }
        .auth-left .ring-3 { width: 160px; height: 160px; bottom: 140px; left: 60px; }

        .auth-left-content { position: relative; z-index: 1; max-width: 380px; }

        .auth-wordmark {
            font-size: 10.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 36px;
            display: block;
        }

        .auth-left h1 {
            font-size: 34px;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -0.8px;
            margin-bottom: 14px;
        }

        .auth-left h1 em {
            font-style: normal;
            background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .auth-left p {
            font-size: 14.5px;
            color: rgba(255,255,255,0.55);
            line-height: 1.75;
            margin-bottom: 36px;
        }

        .auth-features { display: flex; flex-direction: column; gap: 10px; }

        .auth-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            transition: background .2s;
        }

        .auth-feature:hover { background: rgba(255,255,255,0.08); }

        .auth-feature-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
            flex-shrink: 0;
        }

        .auth-feature span {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
        }

        /* ── Right panel ── */
        .auth-right {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 52px 56px;
        }

        .auth-form-wrap { width: 100%; max-width: 380px; }

        .auth-form-header { margin-bottom: 28px; }

        .auth-form-header h2 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
        }

        .auth-form-header p {
            font-size: 13.5px;
            color: #94a3b8;
            font-weight: 500;
            line-height: 1.5;
        }

        /* ── Alerts ── */
        .auth-alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid transparent;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .auth-alert-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .auth-alert.success { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }
        .auth-alert.success .auth-alert-dot { background: #16a34a; }
        .auth-alert.error   { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        .auth-alert.error   .auth-alert-dot { background: #dc2626; }

        /* ── Form ── */
        .auth-form-group { margin-bottom: 16px; }

        .auth-form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 7px;
        }

        .auth-input-wrap { position: relative; }

        .auth-input-wrap svg {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            stroke: #94a3b8;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }

        .auth-input-wrap input {
            width: 100%;
            padding: 11px 14px 11px 38px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: #1f2937;
            background: #fafafa;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .auth-input-wrap input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
            background: #fff;
        }

        .auth-input-wrap input::placeholder { color: #c4c9d4; }

        .field-error {
            font-size: 11.5px;
            color: #dc2626;
            font-weight: 600;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .field-error::before {
            content: '';
            width: 3px; height: 3px;
            border-radius: 50%;
            background: #dc2626;
            display: inline-block;
            flex-shrink: 0;
        }

        /* ── Row for two inputs ── */
        .auth-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        /* ── Submit button ── */
        .auth-btn {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            letter-spacing: 0.2px;
            box-shadow: 0 6px 20px -4px rgba(79,70,229,0.45);
            transition: transform .15s ease, box-shadow .15s ease;
            margin-top: 20px;
        }

        .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px -4px rgba(79,70,229,0.55);
        }

        .auth-btn:active { transform: translateY(0); }

        /* ── Divider ── */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            font-size: 11.5px;
            font-weight: 700;
            color: #d1d5db;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }

        /* ── Footer link ── */
        .auth-footer-link {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
        }

        .auth-footer-link a {
            color: #4f46e5;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-footer-link a:hover { text-decoration: underline; }

        /* ── Admin hint ── */
        .auth-hint {
            margin-top: 24px;
            padding: 12px 16px;
            background: #f8faff;
            border: 1px solid #e0e7ff;
            border-radius: 10px;
            font-size: 12px;
            color: #4338ca;
            text-align: center;
            line-height: 1.65;
            font-weight: 500;
        }

        @media (max-width: 800px) {
            body { flex-direction: column; }
            .auth-left { width: 100%; padding: 44px 28px; }
            .auth-left h1 { font-size: 26px; }
            .auth-features { display: none; }
            .auth-right { padding: 40px 24px; }
            .auth-form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="auth-left">
        <div class="ring ring-1"></div>
        <div class="ring ring-2"></div>
        <div class="ring ring-3"></div>
        <div class="auth-left-content">
            <span class="auth-wordmark">Lotlot Event Booking</span>
            <h1>Book events <em>with confidence.</em></h1>
            <p>Manage reservations, monitor bookings, and organize events from one modern platform.</p>
            <div class="auth-features">
                <div class="auth-feature">
                    <span class="auth-feature-dot"></span>
                    <span>Secure account authentication</span>
                </div>
                <div class="auth-feature">
                    <span class="auth-feature-dot"></span>
                    <span>Live booking calendar</span>
                </div>
                <div class="auth-feature">
                    <span class="auth-feature-dot"></span>
                    <span>Fast reservation workflow</span>
                </div>
                <div class="auth-feature">
                    <span class="auth-feature-dot"></span>
                    <span>Professional event management</span>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">

            @if (session('success'))
                <div class="auth-alert success">
                    <span class="auth-alert-dot"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="auth-alert error">
                    <span class="auth-alert-dot"></span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')

        </div>
    </div>

</body>
</html>