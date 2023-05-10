@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Meus Perfil</h1>
@endsection

@section('content')

    <form action="{{ route('profile.save') }}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')

        @if (session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name">Nome Completo</label>
                        <input value="{{ $user->name }}" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Informe seu nome">

                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email">E-mail</label>
                        <input value="{{ $user->email }}" name="email" type="text"
                            class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Informe seu e-mail">

                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="password">Nova senha</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Informe sua senha">

                        @error('password')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="passwordConfirm">Confirme sua senha</label>
                        <input name="password_confirmation" type="password" class="form-control" id="passwordConfirm"
                            placeholder="Confirme sua senha">
                    </div>

                </div>

                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-sm btn-danger btn-block">Salvar</button>
                </div>
            </div>

        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
