@extends('layouts.auth-navarro')
@section('title', 'Register — Lotlot Event Booking')

@section('content')

<div class="auth-form-header">
    <h2>Create your account</h2>
    <p>Fill in your details below to get started.</p>
</div>

<form method="POST" action="{{ route('register.navarro.store') }}">
    @csrf

    <div class="auth-form-group">
        <label>Full Name</label>
        <div class="auth-input-wrap">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Juan Dela Cruz" autofocus>
        </div>
        @error('name')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="auth-form-group">
        <label>Email Address</label>
        <div class="auth-input-wrap">
            <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com">
        </div>
        @error('email')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="auth-form-row">
        <div class="auth-form-group">
            <label>Password</label>
            <div class="auth-input-wrap">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input type="password" name="password" placeholder="Min. 8 characters">
            </div>
            @error('password')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <div class="auth-form-group">
            <label>Confirm Password</label>
            <div class="auth-input-wrap">
                <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input type="password" name="password_confirmation" placeholder="Repeat password">
            </div>
        </div>
    </div>

    <button type="submit" class="auth-btn">Create Account</button>

</form>

<div class="auth-divider">or</div>

<div class="auth-footer-link">
    Already have an account? <a href="{{ route('login.navarro') }}">Log in here</a>
</div>

<div class="auth-hint">
    Admin access uses the login page.<br>
    You will be redirected to the admin panel automatically.
</div>

@endsection