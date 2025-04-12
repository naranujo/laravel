@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center w-75 container mt-5 mb-5">
        <div class="mt-5">
            <h1 class="mt-5 mb-5">Error {{ $error->code }}</h1>
            <h2 class="mt-2 mb-2">
                {{ $error->message }}
            </h2>
            <p class="mt-2 mb-2">
                {{ $error->description }}
            </p>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">Regresar</a>
            <a href="{{ url('/') }}" class="btn btn-secondary mt-4">Inicio</a>
        </div>
    </div>
@endsection