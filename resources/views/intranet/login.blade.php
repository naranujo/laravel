<!-- resources/views/login.blade.php -->

@extends('layouts.intranet')

@section('title')
    <h1 class="pt-5">{{ $title }}</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('submit.login') }}" class="form w-50 mt-5">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{ $emailLabel }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="johndoe@email.com" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ $passwordLabel }}</label>
            <div class="input-group d-flex mb-2">
                <input type="password" class="form-control" id="password" name="password" required>
                <div id="togglePassword" class="bg-white d-flex align-items-center mr-2 border-0">
                    <i class="bi bi-eye-slash-fill text-primary"></i>
                </div>
            </div>
            <a href="{{ route('view.forgot_password', ['lang' => $lang]) }}" class="text-secondary">{{ $forgotPasswordLabel }}</a>
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 mt-2 mb-4">{{ $title }}</button>
        <p>{{ $registerLabel0 }}<a href="{{ route('view.register', ['lang' => $lang]) }}" class="text-secondary" style="text-decoration:underline;">{{ $registerLabel1 }}</a></p>
    </form>
    @if (session('error'))
        <p class="mt-3 text-danger">{{ session('error') }}</p>
    @endif
@endsection