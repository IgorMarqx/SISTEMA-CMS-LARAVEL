@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Minhas configurações</h1>
@endsection


@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.save') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="title">Titulo do site</label>
                            <input value="{{ $settings['title'] }}" name="title" type="text"
                                class="form-control  @error('title') is-invalid @enderror" id="title"
                                placeholder="Informe o titulo do site">

                            @error('title')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="subtitle">Subtitulo do site</label>
                            <input value="{{ $settings['subtitle'] }}" name="subtitle" type="text"
                                class="form-control  @error('subtitle') is-invalid @enderror" id="subtitle"
                                placeholder="Informe o Sub-titulo do site">

                            @error('subtitle')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="email">Email do site</label>
                            <input value="{{ $settings['email'] }}" name="email" type="email"
                                class="form-control  @error('email') is-invalid @enderror" id="email"
                                placeholder="Informe o email do site">

                            @error('email')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="color">Cor do fundo</label>
                            <input value="{{ $settings['bgcolor'] }}" name="bgcolor" type="color"
                                class="form-control  @error('color') is-invalid @enderror" id="color"
                                placeholder="Informe a cor de fundo do site">

                            @error('color')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="textcolor">Cor do texto</label>
                            <input value="{{ $settings['textcolor'] }}" name="textcolor" type="color"
                                class="form-control  @error('textcolor') is-invalid @enderror" id="textcolor"
                                placeholder="Informe a cor de texto do site">

                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn-block btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
