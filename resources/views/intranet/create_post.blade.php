<!-- resources/views/create_post.blade.php -->

@extends('layouts.intranet')

@section('title')
    <h1 class="pt-5">{{ $title }}</h1>
@endsection

@section('content')
    <!-- fomrulario de nuevo posteo -->

    <form method="POST" action="{{ route('submit.store_post') }}" class="form">
        @csrf
        <br>
        <h6>Título</h6>
        <div class="editor-container-title" id="title" style="height: 40px;"></div>
        <input type="hidden" name="title" id="title-input">
        <br>

        <h6>Resumen</h6>
        <div class="editor-container-resume" id="resume" style="height: 80px;"></div>
        <input type="hidden" name="resume" id="resume-input">
        <br>

        <h6>Imagen</h6>
        <!-- select -->
        <select name="image" id="image" class="form-select">
            <option value="" selected disabled>Selecciona una imagen</option>
            <option value="img1.jpg">Imagen 1</option>
            <option value="img2.jpg">Imagen 2</option>
            <option value="img3.jpg">Imagen 3</option>
            <option value="img4.jpg">Imagen 4</option>
        </select>
        <br>
        <br>

        <h6>Categoría</h6>
        <!-- select -->
        <select name="category_name" id="category" class="form-select">
            <option value="" selected disabled>Selecciona una categoría</option>
            <option value="Category 1">Categoría 1</option>
            <option value="Category 2">Categoría 2</option>
            <option value="Category 3">Categoría 3</option>
            <option value="Category 4">Categoría 4</option>
        </select>
        <br>

        <div id="sections-container">
            <!-- Secciones dinámicas aparecerán aquí -->
        </div>

        <br>
        <button type="button" id="add-section" class="btn btn-secondary mt-2">Agregar Sección</button>
        <br>
        <button type="submit" class="btn btn-primary bg-primary border-0 mt-2 mb-2">Publicar</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let quillTitle = new Quill('#title', {
                theme: 'snow',
                modules: { toolbar: [['bold', 'italic', 'underline']] }
            });

            let quillResume = new Quill('#resume', {
                theme: 'snow',
                modules: { toolbar: [['bold', 'italic', 'underline']] }
            });

            let sectionCount = 0;
            const sectionsContainer = document.getElementById('sections-container');
            const form = document.querySelector('form');

            document.getElementById('add-section').addEventListener('click', function () {
                sectionCount++;
                const sectionId = `section-${sectionCount}`;

                const sectionHtml = `
                    <hr class="bg-primary mw-100 w-100">
                    <section id="${sectionId}" class="shadow p-2 mt-3">
                        <h5 class="font-weight-bolder">Sección ${sectionCount}</h5>
                        <h6>Subtítulo</h6>
                        <div class="editor-container-subtitle" id="subtitle-${sectionCount}" style="height: 40px;"></div>
                        <input type="hidden" name="sections[${sectionCount}][subtitle]" id="subtitle-input-${sectionCount}">
                        <br>
                        <h6>Contenido</h6>
                        <div class="editor-container-content" id="content-${sectionCount}" style="height: 120px;"></div>
                        <input type="hidden" name="sections[${sectionCount}][content]" id="content-input-${sectionCount}">
                    </section>
                `;

                sectionsContainer.insertAdjacentHTML('beforeend', sectionHtml);

                window[`quillSubtitle${sectionCount}`] = new Quill(`#subtitle-${sectionCount}`, {
                    theme: 'snow',
                    modules: { toolbar: [['bold', 'italic', 'underline']] }
                });

                window[`quillContent${sectionCount}`] = new Quill(`#content-${sectionCount}`, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                            ['link']
                        ]
                    }
                });

                // Ahora agregamos los manejadores de eventos para el text-change para cada nueva sección
                window[`quillSubtitle${sectionCount}`].on('text-change', function () {
                    document.getElementById(`subtitle-input-${sectionCount}`).value = window[`quillSubtitle${sectionCount}`].root.innerHTML.trim();
                });

                window[`quillContent${sectionCount}`].on('text-change', function () {
                    document.getElementById(`content-input-${sectionCount}`).value = window[`quillContent${sectionCount}`].root.innerHTML.trim();
                });
            });

            // Manejadores para título y resumen
            quillTitle.on('text-change', function () {
                document.getElementById('title-input').value = quillTitle.root.innerHTML.trim();
            });
            
            quillResume.on('text-change', function () {
                document.getElementById('resume-input').value = quillResume.root.innerHTML.trim();
            });
        });
    </script>
@endsection