<!-- resources/views/reset_password.blade.php -->

@extends('layouts.intranet')

@section('title')
    <h1 class="pt-5">{{ $title }}</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('submit.reset_password_token', ['token' => $token]) }}" class="form w-50 mt-5">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">{{ $passwordLabel }}</label>
            <div class="input-group d-flex mb-2">
                <input type="password" class="form-control" id="password" name="password" required>
                <div id="togglePassword" class="bg-white d-flex align-items-center mr-2 border-0">
                    <i class="bi bi-eye-slash-fill text-primary"></i>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ $confirmPasswordLabel }}</label>
            <div class="input-group d-flex mb-2">
                <input type="password" class="form-control" id="password" name="password" required>
                <div id="togglePassword" class="bg-white d-flex align-items-center mr-2 border-0">
                    <i class="bi bi-eye-slash-fill text-primary"></i>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 mt-2 mb-4">{{ $title }}</button>
    </form>
    @if (session('error'))
        <p class="mt-3 text-danger">{{ session('error') }}</p>
    @endif
@endsection