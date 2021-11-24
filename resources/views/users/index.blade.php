@extends('layouts.app', ['title' => __('Perfil del Usuario')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Gestionar Usuarios'),
    'description' => __('Crea, Modifica, Elimina usuarios... Gestiona la información relacionada en nuestro sistema.'),
    'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Usuarios Activos</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary">Agregar Usuario</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>
                    {!! $users !!}
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Genero</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{!! $user->name !!}</td>
                                        <td>
                                            <a href="mailto:{!! $user->email !!}">{!! $user->email !!}</a>
                                        </td>
                                        <td>{!! $user->role !!}</td>
                                        <td>{!! $user->gender !!}</td>
                                        <td>{!! $user->phone !!}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="">Visualizar</a>
                                                    <a class="dropdown-item" href="">Editar</a>
                                                    <a class="dropdown-item" href="">Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $users->render() !!}
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
