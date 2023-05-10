@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1 class="mb-3">Minhas Páginas</h1>
    <a class="btn btn-sm btn-info" href="{{ route('pages.create') }}">Nova página</a>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card card-primary">
        <div class="card-header">
        </div>
        <table class="table table-hover">
            <tr>
                <th width="50">ID</th>
                <th>Titulo</th>
                <th width="250">Ações</th>
            </tr>

            @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>
                        <a href="" class="text-sm text-success">
                            <i class="fa-regular fa-newspaper ml-1 mr-1 text-xs"></i>
                            Ver mais
                        </a>

                        <a href="{{ route('pages.edit', ['page' => $page->id]) }}" class="text-sm text-warning">
                            <i class="fa-solid fa-pen ml-1 mr-1 text-xs"></i>
                            Editar
                        </a>

                        <a type="button" class="text-sm text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-trash-can ml-1 mr-1 text-xs"></i>
                            Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: red">Deletando Página</h5>
                </div>
                <div class="modal-body">
                    <span style="color: red">Você tem certeza que deseja excluir?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Fechar</button>

                    <form class="d-inline" action="{{ route('pages.destroy', ['page' => $page->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Excluir" class="btn btn-sm btn-outline-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{ $pages->links('pagination::bootstrap-4') }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
