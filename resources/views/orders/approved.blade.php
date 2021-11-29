@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Pago: Paso 2'),
        'description' => __('Estado final de tu pedido.'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 col-md-4 mb-5 pl-1 pr-1">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
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
