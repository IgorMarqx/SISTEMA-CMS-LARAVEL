@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1 class="mb-3">Atualizar Página</h1>
    <a class="btn btn-sm btn-success text-white" href="{{ route('pages.index') }}">Listagem de Páginas</a>
@endsection


@section('content')
    @csrf
    <form action="{{ route('pages.update', ['page' => $page->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title">Titulo da página</label>
                        <input value="{{ $page->title }}" name="title" type="text"
                            class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Informe o titulo da página">

                        @error('title')
                            <span style="color: red">{{ $message }}</span>
                        @enderror

                        @error('slug')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="body">Corpo da página</label>
                        <textarea class="form-control bodyfield" name="body" id="" cols="10" rows="5">{{ $page->body }}</textarea>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-sm btn-success btn-block text-white">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea.bodyfield',
            height: 300,
            menubar: false,
            plugins: ['link', 'table', 'image', 'autoresize', 'lists'],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist |',
            content_css:[
                '{{asset('assets/css/content.css')}}'
            ]
        });
    </script>
@endsection
