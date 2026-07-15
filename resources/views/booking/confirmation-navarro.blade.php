@extends('layouts.app-navarro')
@section('title', 'Upload Confirmation')
@section('step1class', 'done')
@section('step2class', 'done')
@section('step3class', 'active')
@section('content')
    <h1>Upload Confirmation</h1>
    <p class="subtitle">{{ $eventType->name }} at <strong>{{ $venue->name }}</strong> on <strong>{{ $details['booking_date'] }}</strong></p>
    <p class="subtitle">Accepted formats: PDF, JPG, PNG. Max size: 2MB.</p>
    <form method="POST" action="{{ route('booking.confirmation.store') }}" enctype="multipart/form-data">
        @csrf
        <label>Confirmation File</label>
        <input type="file" name="confirmation_file" accept=".pdf,.jpg,.jpeg,.png">
        @error('confirmation_file')<div class="field-error">{{ $message }}</div>@enderror

        <div class="btn-row">
            <a class="btn btn-outline" href="{{ route('booking.details') }}">← Back</a>
            <button type="submit">Upload & Continue →</button>
        </div>
    </form>
@endsection