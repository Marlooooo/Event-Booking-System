@extends('layouts.app-navarro')
@section('title', 'Welcome')
@section('step1class', 'active')
@section('content')
    <h1>Welcome 👋</h1>
    <p class="subtitle">Let's get started — what's your name?</p>

    <form method="POST" action="{{ route('booking.start.store') }}">
        @csrf
        <label>Your Name</label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $old) }}" placeholder="e.g. Juan Dela Cruz" autofocus>
        @error('customer_name')<div class="field-error">{{ $message }}</div>@enderror

        <button type="submit">Continue →</button>
    </form>

    <p class="subtitle" style="margin-top:20px;">After this, you'll fill in your booking details, upload a confirmation document, and review a summary — 3 quick steps.</p>
@endsection