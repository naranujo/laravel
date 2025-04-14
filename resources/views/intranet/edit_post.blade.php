@extends('layouts.intranet')

@section('title')
    <h1 class="pt-5">Editar Posteo</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('submit.edit_post', $post->id) }}" class="form">
        @csrf
        <br>

        <h6>Título</h6>
        <div class="editor-container-title" id="title" style="height: 40px;"></div>
        <input type="hidden" name="title" id="title-input" value="{{ $post->title }}">
        <br>

        <h6>Resumen</h6>
        <div class="editor-container-resume" id="resume" style="height: 80px;"></div>
        <input type="hidden" name="resume" id="resume-input" value="{{ $post->resume }}">
        <br>

        <h6>Imagen</h6>
        <select name="image" id="image" class="form-select">
            <option value="" disabled>Selecciona una imagen</option>
            @foreach(['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'] as $img)
                <option value="{{ $img }}" {{ $post->image === $img ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('.jpg', '', $img)) }}
                </option>
            @endforeach
        </select>
        <br><br>

        <h6>Categoría</h6>
        <select name="category_name" id="category" class="form-select">
            <option value="" disabled>Selecciona una categoría</option>
            @foreach(['Category 1', 'Category 2', 'Category 3', 'Category 4'] as $category)
                <option value="{{ $category }}" {{ $post->category_name === $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
        <br>

        <div id="sections-container">
            @foreach($post->sections as $index => $section)
                <hr class="bg-primary mw-100 w-100">
                <section id="section-{{ $index }}" class="shadow p-2 mt-3">
                    <h5 class="font-weight-bolder">Sección {{ $index + 1 }}</h5>

                    <h6>Subtítulo</h6>
                    <div class="editor-container-title" id="title-{{ $index }}" style="height: 40px;"></div>
                    <input type="hidden" name="sections[{{ $index }}][title]" id="title-input-{{ $index }}" value="{{ $section['title'] }}">
                    <br>

                    <h6>Contenido</h6>
                    <div class="editor-container-content" id="content-{{ $index }}" style="height: 120px;"></div>
                    <input type="hidden" name="sections[{{ $index }}][content]" id="content-input-{{ $index }}" value="{{ $section['content'] }}">
                </section>
            @endforeach
        </div>

        <br>
        <button type="button" id="add-section" class="btn btn-secondary mt-2">Agregar Sección</button>
        <br>
        <button type="submit" class="btn btn-primary bg-primary border-0 mt-2 mb-2">Guardar Cambios</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar Quill para título y resumen
            const quillTitle = new Quill('#title', {
                theme: 'snow',
                modules: { toolbar: [['bold', 'italic', 'underline']] }
            });
            quillTitle.root.innerHTML = {!! json_encode($post->title) !!};
            quillTitle.on('text-change', () => {
                document.getElementById('title-input').value = quillTitle.root.innerHTML.trim();
            });

            const quillResume = new Quill('#resume', {
                theme: 'snow',
                modules: { toolbar: [['bold', 'italic', 'underline']] }
            });
            quillResume.root.innerHTML = {!! json_encode($post->resume) !!};
            quillResume.on('text-change', () => {
                document.getElementById('resume-input').value = quillResume.root.innerHTML.trim();
            });

            // Secciones ya existentes
            let sectionCount = {{ count($post->sections) }};
            for (let i = 0; i < sectionCount; i++) {
                window[`quilltitle${i}`] = new Quill(`#title-${i}`, {
                    theme: 'snow',
                    modules: { toolbar: [['bold', 'italic', 'underline']] }
                });
                window[`quilltitle${i}`].root.innerHTML = document.getElementById(`title-input-${i}`).value;
                window[`quilltitle${i}`].on('text-change', () => {
                    document.getElementById(`title-input-${i}`).value = window[`quilltitle${i}`].root.innerHTML.trim();
                });

                window[`quillContent${i}`] = new Quill(`#content-${i}`, {
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
                window[`quillContent${i}`].root.innerHTML = document.getElementById(`content-input-${i}`).value;
                window[`quillContent${i}`].on('text-change', () => {
                    document.getElementById(`content-input-${i}`).value = window[`quillContent${i}`].root.innerHTML.trim();
                });
            }

            // Agregar nuevas secciones
            document.getElementById('add-section').addEventListener('click', function () {
                const sectionId = `section-${sectionCount}`;
                const sectionHtml = `
                    <hr class="bg-primary mw-100 w-100">
                    <section id="${sectionId}" class="shadow p-2 mt-3">
                        <h5 class="font-weight-bolder">Sección ${sectionCount + 1}</h5>
                        <h6>Subtítulo</h6>
                        <div class="editor-container-title" id="title-${sectionCount}" style="height: 40px;"></div>
                        <input type="hidden" name="sections[${sectionCount}][title]" id="title-input-${sectionCount}">
                        <br>
                        <h6>Contenido</h6>
                        <div class="editor-container-content" id="content-${sectionCount}" style="height: 120px;"></div>
                        <input type="hidden" name="sections[${sectionCount}][content]" id="content-input-${sectionCount}">
                    </section>
                `;
                document.getElementById('sections-container').insertAdjacentHTML('beforeend', sectionHtml);

                window[`quilltitle${sectionCount}`] = new Quill(`#title-${sectionCount}`, {
                    theme: 'snow',
                    modules: { toolbar: [['bold', 'italic', 'underline']] }
                });
                window[`quilltitle${sectionCount}`].on('text-change', () => {
                    document.getElementById(`title-input-${sectionCount}`).value = window[`quilltitle${sectionCount}`].root.innerHTML.trim();
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
                window[`quillContent${sectionCount}`].on('text-change', () => {
                    document.getElementById(`content-input-${sectionCount}`).value = window[`quillContent${sectionCount}`].root.innerHTML.trim();
                });

                sectionCount++;
            });
        });
    </script>
@endsection
