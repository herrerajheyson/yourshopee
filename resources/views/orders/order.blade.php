@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Pago: Paso 1'),
        'description' => __('Por favor llena toda la información solicitada.'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 col-md-8 mb-5 pr-1">
                <div class="card shadow">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="accordion" id="payment_info">
                            <div class="card">
                              <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Información del Usuario
                                  </button>
                                </h2>
                              </div>

                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#payment_info">
                                <div class="card-body">
                                    @if (auth()->guest())
                                        <p>Debes Loguearte para continuar o registrate para seguir con el proceso de pago</p>
                                        @include('auth.layouts.register', [
                                            'route' => route('register.order')
                                        ])
                                    @else
                                        <dl class="row">
                                            <dt class="col-sm-3 mb-0">Nombres</dt>
                                            <dd class="col-sm-9 mb-0">
                                                <p>{{auth()->user()->name}}</p>
                                            </dd>
                                            <dt class="col-sm-3 mb-0">Email</dt>
                                            <dd class="col-sm-9 mb-0">
                                                <p>{{auth()->user()->email}}</p>
                                            </dd>
                                            <dt class="col-sm-3 mb-0">Teléfono</dt>
                                            <dd class="col-sm-9 mb-0">
                                                <p>{{auth()->user()->phone}}</p>
                                            </dd>
                                            <dt class="col-sm-3 mb-0 text-truncate">Dirección</dt>
                                            <dd class="col-sm-9 mb-0">
                                                <p>{{auth()->user()->address}}</p>
                                            </dd>
                                        </dl>
                                    @endif
                                </div>
                              </div>
                            </div>
                            @if (!auth()->guest())
                                <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Información de pago
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#payment_info">
                                    <div class="card-body">
                                        {{ Form::open(array(
                                            'url' => route('payment'),
                                            'method' => 'POST',
                                            'role' => 'form',
                                            'enctype' => 'multipart/form-data'
                                        )) }}
                                            {!! Form::hidden('amount', $total, []) !!}
                                            {!! Form::hidden('currency', 'COP', []) !!}
                                            {!! Form::hidden('order', $order, []) !!}
                                            <div class="text-center">
                                                {!! Form::submit(__('Ir a la pasarale de pago!'), ['class' => 'btn btn-primary mt-4']) !!}
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-5 pl-1 pr-1">
                <div class="card shadow">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <tbody>
                                @if (isset($detail))
                                    @foreach ($detail as $data)
                                        <tr>
                                            <td class="text-center">
                                                <output id="list">
                                                    <img class="img-fluid img-thumbnail rounded-lg" style="width: 100px;" src="{{ asset('argon') }}/img/products/{{$data[1]->image}}" alt="Imagen de Referencia">
                                                </output>
                                            </td>
                                            <td>
                                                <strong><h5 class="m-0">{{$data[1]->brand}}</h5></strong>
                                                <p class="m-0">{{$data[1]->name}}</p>
                                                <strong><h6 class="m-0">{{$data[1]->reference}}</h6></strong>
                                                <h4><span class="badge badge-success">-{!!$data[1]->discount!!}%</span> <strong>{!!'$ ' . number_format($data[1]->price, 2)!!}</strong></h4>
                                                <p class="mt-1 mb-1">{{$data[0]}} Ud</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <hr>
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td class="text-left"><strong>Subtotal</strong></td>
                                    <td class="text-right" id="subtotal">{!!'$' . number_format($subtotal)!!}</td>
                                </tr>
                                <tr>
                                    <td class="text-left"><strong>Descuento</strong></td>
                                    <td class="text-right" id="discount">{!!'$' . number_format($discount)!!}</td>
                                </tr>
                                <tr>
                                    <td class="text-left"><strong>Total</strong></td>
                                    <td class="text-right" id="total">{!!'$' . number_format($total)!!}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <a href="{{ route('home') }}" role="button" class="btn btn-secondary btn-lg mt-3" style="width: 100%;">Seguir Comprando</a>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection
