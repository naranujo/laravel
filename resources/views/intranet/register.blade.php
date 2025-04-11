<!-- resources/views/register.blade.php -->

@extends('layouts.intranet')

@section('title')
    <h1 class="pt-5">{{ $title }}</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('submit.register') }}" class="form w-50 mt-5">
        @csrf
        <div class="mb-3">
            <label for="firstName" class="form-label">{{ $firstNameLabel }}</label>
            <input type="firstName" class="form-control" id="firstName" name="firstName" placeholder="John" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">{{ $lastNameLabel }}</label>
            <input type="lastName" class="form-control" id="lastName" name="lastName" placeholder="Doe" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ $emailLabel }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ $passwordLabel }}</label>
            <div class="input-group d-flex">
                <input type="password" class="form-control" id="password" name="password" required>
                <div id="togglePassword" class="bg-white d-flex align-items-center mr-2 border-0">
                    <i class="bi bi-eye-slash-fill text-primary"></i>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 mt-2 mb-2">{{ $title }}</button>
        <p>{{ $loginLabel0 }}<a href="{{ route('view.login', ['lang' => $lang]) }}" class="text-secondary" style="text-decoration:underline;">{{ $loginLabel1 }}</a></p>
    </form>
    @if (session('error'))
        <p class="mt-3 text-danger">{{ session('error') }}</p>
    @endif
@endsection