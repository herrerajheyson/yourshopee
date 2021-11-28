@extends('layouts.app')

@section('content')
    @php
        try {
            $name = auth()->user()->name;
        } catch (\Throwable $th) {
            $name = '';
        }
    @endphp
    @include('users.partials.header', [
        'title' => __('Hola') . ' '. $name,
        'description' => __('Bienvenido(a) a tu <strong style="font-size: 26px;">tienda en línea</strong> preferida, en <strong style="font-size: 26px;">Your Shopee</strong> encontrarás lo que buscas justo como lo necesitas. No te pierdas la oportunidad y aprovecha nuestras promociones y precios, <strong style="font-size: 26px;">¡Están Increibles!</strong> Adelante...'),
        'class' => 'col-lg-10'
    ])

    <div class="container-fluid mt--7">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show custom-alert-fixed" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->has('amount'))
            <div class="alert alert-warning alert-dismissible fade show custom-alert-fixed" role="alert">
                {{ $errors->first('amount') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div id="messageapi" class="alert alert-success alert-dismissible fade show custom-alert-fixed d-none" role="alert">
            {{ $errors->first('amount') }}
        </div>

        <div class="row">
            <div class="col-12 col-md-9 mb-5 pr-1">
                <div class="card shadow">
                    <div class="card-header">
                        <h2><i class="ni ni-cart text-primary mr-2"></i> Tu Carrito de Compra...</h2>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <p class="mb-5">{!!$message!!}</p>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort text-center">Imagen</th>
                                        <th scope="col" class="sort text-center">Articulo</th>
                                        <th scope="col" class="sort text-center">Precio</th>
                                        <th scope="col" class="sort text-center">Cantidad Solicitada</th>
                                        <th scope="col" class="sort text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td scope="row" class="text-center">
                                                <output id="list">
                                                    <img class="img-fluid img-thumbnail rounded-lg" style="width: 100px;" src="{{ asset('argon') }}/img/products/{{$product->image}}" alt="Imagen de Referencia">
                                                </output>
                                            </td>
                                            <td scope="row" class="text-left">
                                                <p class="card-title">
                                                    <h6>{!!$product->brand!!}</h6>
                                                    <h4>{!!$product->name!!}</h4>
                                                    <h6>{!!$product->reference!!}</h6>
                                                </p>
                                            </td>
                                            <td scope="row" class="text-center">
                                                <h5>
                                                    <span class="badge badge-success">-{!!$product->discount!!}%</span>
                                                    <br>
                                                    <strong>{!!'$' . number_format($product->price, 2)!!}</strong>
                                                </h5>
                                            </td>
                                            <td scope="row" class="text-center">
                                                {!! Form::number('amount', $product->requested_amount, [
                                                    'class' => 'form-control mr-2 text-center updatecar',
                                                    'min' => 0,
                                                    'max' => $product->amount,
                                                    'data-sku' => $product->sku,
                                                    'data-session-user' => Session::get('user_shopping_cart')
                                                ]) !!}
                                            </td>
                                            <td scope="row" class="text-center">
                                                {{ Form::open(array('url' => route('removefromcar'), 'method' => 'POST', 'role' => 'form')) }}
                                                    {!! Form::hidden('sku', $product->sku) !!}
                                                    {!! Form::hidden('name', $product->name) !!}
                                                    {!! Form::submit(__('Eliminar'), [
                                                        "class" => "btn btn-danger",
                                                        "type" => "button"
                                                    ]) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-5 pl-1">
                <div class="card shadow">
                    <div class="card-body px-lg-4 py-lg-4">
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
                        {!! Form::open(array('url' => route('removefromcar'), 'method' => 'POST', 'role' => 'form')) !!}
                            {!! Form::submit('Ir a Pagar', ['class' => 'btn btn-success btn-lg', 'style' => 'width: 100%;']) !!}
                        {!! Form::close() !!}
                        <a href="{{ route('home') }}" role="button" class="btn btn-secondary btn-lg mt-3" style="width: 100%;">Seguir Comprando</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="module">
            import {updateMaster} from '/argon/js/utils.js'

            $('.updatecar').click(function () {
                updateMaster('/api/updatecar', {
                    'sku': $(this).data('sku'),
                    'session_key': $(this).data('session-user'),
                    'amount': parseInt($(this).val()),
                }).then((response) => {
                    $('#subtotal').html('$' + new Intl.NumberFormat("es-CO").format(response.data.subtotal))
                    $('#discount').html('$' + new Intl.NumberFormat("es-CO").format(response.data.discount))
                    $('#total').html('$' + new Intl.NumberFormat("es-CO").format(response.data.total))
                    $('#messageapi').html(response.data.message)

                    $('#messageapi').removeClass('d-none')
                    setTimeout(() => {
                        $('#messageapi').addClass('d-none')
                    }, 3000);
                })
            })
        </script>

        @include('layouts.footers.auth')
    </div>
@endsection
