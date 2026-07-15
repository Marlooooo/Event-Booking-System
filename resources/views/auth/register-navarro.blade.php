@extends('layouts.auth-navarro')
@section('title', 'Register — Lotlot Event Booking')
@section('content')
    <h1>Create Account</h1>
    <p class="subtitle">Start booking your events with Lotlot.</p>

    <form method="POST" action="{{ route('register.navarro.store') }}">
        @csrf
        <label>Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Juan Dela Cruz" autofocus>
        @error('name')<div class="field-error">{{ $message }}</div>@enderror

        <label>Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com">
        @error('email')<div class="field-error">{{ $message }}</div>@enderror

        <label>Password</label>
        <input type="password" name="password" placeholder="At least 8 characters">
        @error('password')<div class="field-error">{{ $message }}</div>@enderror

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Repeat your password">

        <button type="submit" style="width:100%;">Create Account</button>
    </form>

    <p style="text-align:center; margin-top:20px; font-size:14px; color:#6b7280;">
        Already have an account? <a href="{{ route('login.navarro') }}" style="color:#4f46e5; font-weight:600;">Log in here</a>
    </p>
@endsection