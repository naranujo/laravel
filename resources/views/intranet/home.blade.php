<!-- resources/views/intranet.blade.php -->

@extends('layouts.intranet')

@php
    $sinNovedades = [
        'es' => 'No hay novedades',
        'en' => 'No news'
    ];

    $novedades = [
        'es' => 'Novedades',
        'en' => 'News'
    ];

    $leerMas = [
        'es' => 'Leer más',
        'en' => 'Read more'
    ];

    $hasMorePosts = true;
    $page = 1;
    
@endphp

@section('title')
    <h1 class="pt-5">{{ $title }}</h1>
    <!-- Inicio carrusel -->
    @if (count($carrouselPosts) == 0)
        <h6 class="text-primary mx-auto">{{ $sinNovedades[$lang] }}</h6>
    @else
        @foreach ($carrouselPosts as $index => $post)
            <section class="row row-cols-2 shadow position-relative @if ($index != 0) d-none @endif" id="carrusel-{!! $index !!}">
                <section class="col pl-0" id="c-left">
                    <img src="{{ asset('images/posts/'.$post->image) }}" class="w-100" alt="{!! $post->title !!}">
                </section>
                <section class="col pt-4" id="c-right">
                    <p class="text-primary mx-auto">{{ $novedades[$lang] }}</p>
                    <h6 class="text-primary text-justify">{{ $post->title }}</h6>
                    @if (strlen($post->resume) > 150)
                        <p class="text-primary text-justify">{{ substr($post->resume, 0, 150) . ". . ." }}</p>
                    @else
                        <p class="text-primary text-justify">{{ $post->resume }}</p>
                    @endif
                    <div class="d-flex justify-content-between">
                        <a href="/intranet/post{{ $post->id }}" class="text-primary">{{ $leerMas[$lang] }}</a>
                        <h6 class="text-primary"><h6 class="text-right text-primary">{{ $post->formatted_updated_at }}</h6></h6>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="d-flex justify-content-center">
                            @if (count($carrouselPosts) == 1)
                                <div id="00" class="c-indicator mr-3 bg-primary" style="width:30px;height:5px;border:1px solid #000"></div>
                            @elseif (count($carrouselPosts) == 2)
                                <div id="10" class="c-indicator mr-3 <?php echo $index == 0 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                                <div id="11" class="c-indicator mr-3 <?php echo $index == 1 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                            @elseif (count($carrouselPosts) == 3)
                                <div id="20" class="c-indicator mr-3 <?php echo $index == 0 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                                <div id="21" class="c-indicator mr-3 <?php echo $index == 1 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                                <div id="22" class="c-indicator mr-3 <?php echo $index == 2 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                            @elseif (count($carrouselPosts) == 4)
                                <div id="<?php echo $index ."0"; ?>" class="c-indicator mr-3 <?php echo $index == 0 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                                <div id="<?php echo $index ."1"; ?>" class="c-indicator mr-3 <?php echo $index == 1 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                                <div id="<?php echo $index ."2"; ?>" class="c-indicator mr-3 <?php echo $index == 2 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                                <div id="<?php echo $index ."3"; ?>" class="c-indicator mr-3 <?php echo $index == 3 ? "bg-primary" : ""; ?>" style="width:30px;height:5px;border:1px solid #000"></div>
                            @endif
                        </div>
                    </div>
                </section>
            </section>
        @endforeach
        <!-- Inicio novedades -->
        <section class="row row-cols-2 pt-2" id="novedades">
            @php $index = 0; @endphp
            
            @if (count($posts) == 0)
                <h6 class="text-primary text-center mx-auto mt-5">{{ $sinNovedades[$lang] }}</h6>
            @else
                @foreach ($posts as $post)
                    @if ($index % 2 != 0)
                        <article class="col pl-0 text-primary mb-2">
                            <hr class="mw-75 mx-auto" style="border: 5px solid #a99c6b;">
                            <p class="text-primary mx-auto">{{ $novedades[$lang] }}</p>
                            <h6 class="text-primary text-justify">{{ $post->title }}</h6>
                            <div class="d-flex justify-content-between">
                                <a href="/intranet/post{{ $post->id }}" class="text-primary">{{ $leerMas[$lang] }}</a>
                                <h6 class="text-right text-primary">{{ $post->formatted_updated_at }}</h6>
                            </div>
                        </article>
                    @else
                        <article class="col pr-0 text-primary mb-2">
                            <hr class="mw-75 mx-auto" style="border: 5px solid #a99c6b;">
                            <p class="text-primary mx-auto">{{ $novedades[$lang] }}</p>
                            <h6 class="text-primary text-justify">{{ $post->title }}</h6>
                            <div class="d-flex justify-content-between">
                                <a href="/intranet/post{{ $post->id }}" class="text-primary">{{ $leerMas[$lang] }}</a>
                                <h6 class="text-right text-primary">{{ $post->formatted_updated_at }}</h6>
                            </div>
                        </article>
                    @endif
                    @php $index++; @endphp
                @endforeach
            @endif
        </section>
        @if ($hasMorePosts)
            <div class="d-flex justify-content-center">
                <a href="./?page={{ $page + 1 }}" class="btn border border-radius-25 text-white bg-primary w-25 mt-3 mb-3" id="cargar-mas">Cargar más</a>
            </div>
        @endif
        <!-- Fin novedades -->
    @endif
    <script>
        let cIndicators = document.querySelectorAll(".c-indicator");

        let c0 = document.querySelector("#carrusel-0");
        let c1 = document.querySelector("#carrusel-1");
        let c2 = document.querySelector("#carrusel-2");
        let c3 = document.querySelector("#carrusel-3");

        cIndicators.forEach((indicator) => {
            indicator.addEventListener("click", (e) => {
                e.preventDefault();
                let id = e.target.id;

                if (id == "00" || id == "10" || id == "20" || id == "30") {
                    c0.classList.remove("d-none");
                    c1.classList.add("d-none");
                    c2.classList.add("d-none");
                    c3.classList.add("d-none");
                } else if (id == "01" || id == "11" || id == "21" || id == "31") {
                    c0.classList.add("d-none");
                    c1.classList.remove("d-none");
                    c2.classList.add("d-none");
                    c3.classList.add("d-none");
                } else if (id == "02" || id == "12" || id == "22" || id == "32") {
                    c0.classList.add("d-none");
                    c1.classList.add("d-none");
                    c2.classList.remove("d-none");
                    c3.classList.add("d-none");
                } else if (id == "03" || id == "13" || id == "23" || id == "33") {
                    c0.classList.add("d-none");
                    c1.classList.add("d-none");
                    c2.classList.add("d-none");
                    c3.classList.remove("d-none");
                }
            });
        });
    </script>
    <!-- Fin carrusel -->
@endsection