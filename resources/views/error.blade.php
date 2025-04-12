@extends('layouts.app')

@section('content')
    <div class="container h-50 mt-5 mb-5 d-flex flex-column justify-content-center align-items-center" style="height: calc(100vh - 275px) !important;">
        <div class="mt-5 mb-5">
            <h1 class="mt-5 mb-5">Error {{ $error->code }}</h1>
            <h2 class="mt-2 mb-2">
                {!! $error->message[$lang] !!}
            </h2>
            <p class="mt-2 mb-2">
                {!! $error->description[$lang] !!}
            </p>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">Regresar</a>
            <a href="{{ url('/') }}" class="btn btn-secondary mt-4">Inicio</a>
        </div>
    </div>
@endsection