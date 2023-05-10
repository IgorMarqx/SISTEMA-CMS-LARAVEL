@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1 class="mb-3">Novo Usuário</h1>
    <a class="btn btn-sm btn-success" href="{{ route('users.index') }}">Listagem de Usuários</a>
@endsection

@section('content')
    <form action="{{ route('users.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input value="{{ old('name') }}" name="name" type="text"
                        class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Informe seu nome">

                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input value="{{ old('email') }}" name="email" type="text"
                        class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Informe seu e-mail">

                    @error('email')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="acesso">Nivel de Acesso</label>
                    <select class="form-control" name="admin" id="acesso">
                        <option value="0" disabled>Informe seu acesso</option>
                        <option value="">Admin</option>
                        <option value="">Usuário</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="password">Senha</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Informe sua senha">

                    @error('password')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="passwordConfirm">Confirme sua senha</label>
                    <input name="password_confirmation" type="password"
                        class="form-control @error('password') is-invalid @enderror" id="passwordConfirm"
                        placeholder="Confirme sua senha">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
            </div>
        </div>
    </form>
@endsection
