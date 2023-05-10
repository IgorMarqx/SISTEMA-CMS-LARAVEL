@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1 class="mb-3">Nova Página</h1>
    <a class="btn btn-sm btn-success text-white" href="{{ route('pages.index') }}">Listagem de Páginas</a>
@endsection


@section('content')
    @csrf
    <form action="{{ route('pages.store') }}" method="POST">
        @csrf
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title">Titulo da página</label>
                        <input value="{{ old('title') }}" name="title" type="text"
                            class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Informe o titulo da página">

                        @error('title')
                            <span style="color: red">{{ $message }}</span>
                        @enderror

                        @error('slug')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <label for="slug">Slug da página</label>
                        <input disabled value="{{ old('slug') }}" name="slug" type="text"
                            class="form-control @error('slug') is-invalid @enderror" id="emslugail"
                            placeholder="Informe o slug da página">


                    </div> --}}

                    <div class="col-md-12">
                        <label for="body">Corpo da página</label>
                        <textarea value="{{ old('body') }}" class="form-control" name="body" id="" cols="10" rows="5"></textarea>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-sm btn-success btn-block text-white">Criar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
