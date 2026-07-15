<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Lotlot Event Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
        }

        /* ── Left panel ── */
        .left-panel {
            width: 52%;
            background:
                radial-gradient(circle at 15% 15%, rgba(99,102,241,0.35) 0%, transparent 50%),
                radial-gradient(circle at 85% 85%, rgba(124,58,237,0.35) 0%, transparent 50%),
                linear-gradient(135deg, #0f172a 0%, #1e1b4b 55%, #312e81 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 52px;
            position: relative;
            overflow: hidden;
        }

        .left-panel .circle-1 {
            position: absolute;
            width: 420px; height: 420px;
            border-radius: 50%;
            border: 1px solid rgba(99,102,241,0.15);
            top: -130px; left: -130px;
        }

        .left-panel .circle-2 {
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            border: 1px solid rgba(124,58,237,0.15);
            bottom: -80px; right: -80px;
        }

        .left-content {
            position: relative;
            z-index: 1;
            max-width: 400px;
        }

        .brand {
            margin-bottom: 44px;
        }

        .brand .wordmark {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            color: rgba(255,255,255,0.45);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 18px;
        }

        .brand h1 {
            font-size: 38px;
            font-weight: 800;
            color: #fff;
            line-height: 1.18;
            letter-spacing: -0.8px;
        }

        .brand h1 span {
            display: block;
            background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .brand p {
            margin-top: 16px;
            color: rgba(255,255,255,0.5);
            font-size: 15px;
            line-height: 1.7;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            transition: background .2s;
        }

        .feature-item:hover {
            background: rgba(255,255,255,0.08);
        }

        .feature-item .f-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(124,58,237,0.3));
            border: 1px solid rgba(165,180,252,0.2);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature-item .f-icon svg {
            width: 18px; height: 18px;
            stroke: #a5b4fc;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .feature-item .f-text strong {
            display: block;
            font-size: 13.5px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2px;
        }

        .feature-item .f-text span {
            font-size: 12.5px;
            color: rgba(255,255,255,0.45);
            line-height: 1.5;
        }

        /* ── Right panel ── */
        .right-panel {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 52px;
        }

        .form-wrap {
            width: 100%;
            max-width: 380px;
        }

        .form-header {
            margin-bottom: 32px;
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .form-header p {
            color: #6b7280;
            font-size: 14.5px;
            line-height: 1.5;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 500;
            border: 1px solid transparent;
        }
        .alert-error   { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
        .alert-success { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
            letter-spacing: 0.1px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .input-wrap .input-icon svg {
            width: 16px; height: 16px;
            stroke: #9ca3af;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .input-wrap input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: #1f2937;
            background: #fafafa;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .input-wrap input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
            background: #fff;
        }

        .input-wrap input::placeholder {
            color: #c4c9d4;
        }

        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }

        .remember-row {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            color: #6b7280;
            cursor: pointer;
            user-select: none;
        }

        .remember-row input[type=checkbox] {
            width: 15px;
            height: 15px;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            letter-spacing: 0.2px;
            box-shadow: 0 6px 20px -4px rgba(79,70,229,0.45);
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px -4px rgba(79,70,229,0.55);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            font-size: 12.5px;
            font-weight: 600;
            color: #d1d5db;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0f0f0;
        }

        .register-link {
            text-align: center;
            font-size: 13.5px;
            color: #6b7280;
        }

        .register-link a {
            color: #4f46e5;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .admin-hint {
            margin-top: 28px;
            padding: 14px 18px;
            background: #f8faff;
            border: 1px solid #e0e7ff;
            border-radius: 10px;
            font-size: 12.5px;
            color: #4338ca;
            text-align: center;
            line-height: 1.65;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 44px 28px; }
            .brand h1 { font-size: 28px; }
            .feature-list { display: none; }
            .right-panel { padding: 40px 24px; }
        }
    </style>
</head>
<body>

    <!-- Left panel -->
    <div class="left-panel">
        <div class="circle-1"></div>
        <div class="circle-2"></div>

        <div class="left-content">
            <div class="brand">
                <div class="wordmark">Lotlot Event Booking</div>
                <h1>Plan your perfect <span>event with ease.</span></h1>
                <p>Book venues, manage reservations, and track your event status — all in one place.</p>
            </div>

            <div class="feature-list">
                <div class="feature-item">
                    <div class="f-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="f-text">
                        <strong>Choose Your Venue</strong>
                        <span>Browse and reserve from our curated list of venues</span>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div class="f-text">
                        <strong>Manage Bookings</strong>
                        <span>View, edit, or cancel your bookings anytime</span>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="f-text">
                        <strong>Real-time Status</strong>
                        <span>Track pending, accepted, or rejected bookings live</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right panel -->
    <div class="right-panel">
        <div class="form-wrap">

            <div class="form-header">
                <h2>Welcome back</h2>
                <p>Log in to your account to continue booking.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.navarro.store') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" autofocus>
                    </div>
                    @error('email')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
                    @error('password')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="remember-row">
                    <label>
                        <input type="checkbox" name="remember">
                        Keep me logged in
                    </label>
                </div>

                <button type="submit" class="btn-login">Log In</button>
            </form>

            <div class="divider">or</div>

            <div class="register-link">
                Don't have an account?
                <a href="{{ route('register.navarro') }}">Create one here</a>
            </div>

            <div class="admin-hint">
                Admin access uses the same login form above.<br>
                You will be redirected to the admin panel automatically.
            </div>

        </div>
    </div>

</body>
</html>