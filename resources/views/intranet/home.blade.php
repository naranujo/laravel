<!-- resources/views/intranet.blade.php -->

@extends('layouts.intranet')

@section('title')
    <h1 class="pt-5">{{ $title }}</h1>
@endsection

@section('content')
    {{-- listar todos los posts --}}
    @if (count($posts) == 0)
        <h6 class="text-primary mx-auto">{{ $sinNovedades[$lang] }}</h6>
    @else
        <ol class="list-group list-group-numbered">
            @foreach ($posts as $index => $post)
                <li class="d-flex flex-row align-items-center mt-2 mb-2 list-group-item mw-100 w-100">
                    <span class="text-bold mr-2">{{ $index + 1 }}.</span>
                    <a href="/intranet/post/{{ $post->id }}" class="text-primary text-decoration-none">
                        {{ $post->title }} |
                        {{ $post->formatted_created_at }} |
                        {{ $post->status }}
                    </a>
                </li>
            @endforeach
        </ol>
    @endif
@endsection