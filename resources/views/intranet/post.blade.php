<!-- resources/views/news.blade.php -->

@extends('layouts.intranet')

@section('content')
    <article class="pb-4">
        <h1 class="mt-4 mb-4 mx-auto">{!! $post->title !!}</h1>
        <img src="{{ asset('images/posts/'.$post->image) }}" class="w-100 mt-4 mb-4" alt="{!! $post->title !!}">
        <p class="mw-100 w-100 text-black text-justify">{!! $post->resume !!}</p>
        <div class="row row-cols-2 pt-2">
            @foreach ($post->sections as $section)
                <div class="col text-black mb-2">
                    <h5 class="text-black text-center mx-auto mt-5" style="min-height: 3.5rem;">{!! $section->title !!}</h5>
                    <p class="text-black text-justify" style="line-height: 2;">{!! $section->content !!}</p>
                </div>
            @endforeach
        </div>
        <h6 class="text-right text-black">{{ $post->formatted_created_at }}</h6>
        <!-- editar, borrar o descargar solo editor o admin -->
        @if ($loggedIn && ($role == 'editor' || $role == 'admin'))
            <div class="row d-flex justify-content-between">
                <div class="d-flex w-50 justify-content-start">

                    @php
                        $statusOptions = ['draft', 'published', 'archived'];
                    @endphp
                    <select id="statusSelect" class="btn border border-radius-25 text-white bg-primary mt-3 mb-3" aria-label="Estado">
                        <option selected>{{ ucfirst($post->status) }}</option>
                        @foreach ($statusOptions as $s)
                            @if ($s != $post->status)
                                <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                            @endif
                        @endforeach
                    </select>
                    
                    <a href="{{ route('view.edit_post', $post->id) }}" class="btn border border-radius-25 text-white bg-primary mt-3 mb-3">Editar</a>
                    <form action="{{ route('submit.delete_post', $post->id) }}" method="POST" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn border border-radius-25 text-white bg-primary mt-3">Eliminar</button>
                    </form>
                    <a href="{{ route('download.post', $post->id) }}" class="btn border border-radius-25 text-white bg-primary mt-3 mb-3">Descargar</a>
                </div>
                <div class="w-50 justify-content-end d-none" id="saveChangesContainer">
                    <form action="{{ route('submit.change_status', $post->id) }}" method="POST" id="statusForm">
                        @csrf
                        <input type="hidden" name="status" value="" id="statusInput">
                    </form>
                    <p class="text-secondary m-auto">¡Hay cambios pendientes!</p>
                    <button id="saveChangesButton" class="btn border border-radius-25 text-white bg-primary mt-3 mb-3">Guardar cambios</button>
                </div>
            </div>

            <script>
                let status = @json($post->status);
                
                document.addEventListener('DOMContentLoaded', function() {
                    const statusSelect = document.getElementById('statusSelect');
                    const saveChangesContainer = document.getElementById('saveChangesContainer');
                    const saveChangesButton = document.getElementById('saveChangesButton');
                    const statusInput = document.getElementById('statusInput');
                    const statusForm = document.getElementById('statusForm');
                    const statusOptions = statusSelect.options;

                    statusSelect.addEventListener('change', function() {
                        if (this.value !== status) {
                            saveChangesContainer.classList.remove('d-none');
                            saveChangesContainer.classList.add('d-flex');
                        } else {
                            saveChangesContainer.classList.remove('d-flex');
                            saveChangesContainer.classList.add('d-none');
                        }
                    });

                    saveChangesButton.addEventListener('click', function() {
                        statusInput.value = statusSelect.value;
                        statusForm.submit();
                    });
                });
            </script>
            
        @endif
    </article>
@endsection
