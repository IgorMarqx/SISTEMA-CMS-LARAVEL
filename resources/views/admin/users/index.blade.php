@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Meus Usuários</h1>
    <br>
    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Novo Usuário</a>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="card card-primary">
        <div class="card-header">
        </div>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Acesso</th>
                <th>Ações</th>
            </tr>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->admin !== 0)
                            <p class="btn btn-sm btn-outline-warning rounded">Admin</p>
                        @else
                            <p class="btn btn-sm btn-outline-primary rounded">Usuário</p>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="text-sm text-warning">
                            <i class="fa-solid fa-pen ml-1 mr-1 text-xs"></i>
                            Editar
                        </a>

                        @if ($loggedId !== intval($user->id))
                            <a type="button" class="text-sm text-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa-solid fa-trash-can ml-1 mr-1 text-xs"></i>
                                Excluir
                            </a>
                        @else
                            <span disabled class="text-sm text-success">
                                <i class="fa-solid fa-circle text-xs ml-1 "></i>
                                Logado
                            </span>
                        @endif

                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: red">Deletando Usuário</h5>
                </div>
                <div class="modal-body">
                    <span style="color: red">Você tem certeza que deseja excluir?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Fechar</button>

                    <form class="d-inline" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Excluir" class="btn btn-sm btn-outline-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{ $users->links('pagination::bootstrap-4') }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
