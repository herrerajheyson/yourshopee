@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => ($type_view)
            ? __('Gestionar Pedidos')
            : __('Visualizar Pedidos'),
        'description' => ($type_view)
            ? __('Gestiona la información relacionada en nuestro sistema.')
            : __('Visualiza toda la información de los pedidos realizados por tu usuario en el sistema.'),
        'class' => 'col-lg-12'
    ])

    @php
        $status = array(
            'CREATED' => 'CREADO',
            'PAYED' => 'PAGADO',
            'REJECTED' => 'RECHAZADO'
        );
    @endphp

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">
                                    {{$title}}
                                </h3>
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
                                        <th scope="col" class="sort text-center">Nro Orden</th>
                                        <th scope="col" class="sort text-center">Usuario</th>
                                        <th scope="col" class="sort text-center">Email</th>
                                        <th scope="col" class="sort text-center">Teléfono</th>
                                        <th scope="col" class="sort text-center">Estado</th>
                                        <th scope="col" class="sort text-center">Fecha del Pedido</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td scope="row" class="text-center">{!! $order->id !!}</td>
                                            <td scope="row" class="text-center">{!! $order->customer_name !!}</td>
                                            <td scope="row" class="text-center">{!! $order->customer_email !!}</td>
                                            <td scope="row" class="text-center">{!! $order->customer_mobile !!}</td>
                                            <td scope="row" class="text-center">{!! $status[$order->status] !!}</td>
                                            <td scope="row" class="text-center">{!! $order->created_at !!}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item"
                                                            href="{{ route('orders.show', ['order' => $order->id]) }}">Visualizar</a>
                                                        @if (!$type_view && $status[$order->status] = 'CREADO')
                                                            <a class="dropdown-item" href="{{ route('orderfirststep.option', ['order' => $order->id]) }}">Seguir Pago</a>
                                                        @endif
                                                        @if ($type_view)
                                                            <a class="dropdown-item"
                                                                href="#"
                                                                onclick="destroy({!!$order->id!!})">Eliminar</a>
                                                        @endif
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
                form_destroy.action = '/orders/' + element
                form_destroy.submit()
            }
        </script>

        @include('layouts.footers.auth')
    </div>

@endsection
