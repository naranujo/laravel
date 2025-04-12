<!-- resources/views/forgot_password.blade.php -->

@extends('layouts.intranet')

@section('content')
    <form method="POST" action="{{ route('submit.forgot_password') }}" class="form w-50 mt-5">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{ $emailLabel }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="johndoe@email.com" required>
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 mt-2 mb-4">{{ $title }}</button>
        <p>{{ $loginLabel0 }}<a href="{{ route('view.login', ['lang' => $lang]) }}" class="text-secondary" style="text-decoration:underline;">{{ $loginLabel1 }}</a></p>
    </form>
    @if (session('success'))
        <p class="mt-3 text-secondary">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="mt-3 text-danger">{{ session('error') }}</p>
    @endif
@endsection
