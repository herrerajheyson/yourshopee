@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
    'title' => __('Gestionar Categorías'),
    'description' => __('Crea, Modifica y Elimina... Gestiona la información relacionada en nuestro sistema.'),
    'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Categorías Activas</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Agregar Categoría</a>
                            </div>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Nombres</th>
                                        <th scope="col" class="sort" data-sort="description">Descripción</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td scope="row">{!! $category->name !!}</td>
                                            <td scope="row">{!! $category->description !!}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item"
                                                            href="{{ route('category.show', ['category' => $category->id]) }}">Visualizar</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('category.edit', ['category' => $category->id]) }}">Editar</a>
                                                        <a class="dropdown-item"
                                                            href="#"
                                                            onclick="destroy({!!$category->id!!})">Eliminar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="destroy" method="POST" class="d-none">
            @csrf
            @method('delete')
        </form>

        <script>
            function destroy(element) {
                event.preventDefault();
                let form_destroy = document.getElementById('destroy')
                form_destroy.action = '/category/' + element
                form_destroy.submit()
            }
        </script>

        @include('layouts.footers.auth')
    </div>
@endsection
