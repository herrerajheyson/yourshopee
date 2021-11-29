@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Orden N°: ') . $order->id,
        'description' => __('A continuación podrás ver toda la información que corresponde al registro seleccionado.'),
        'class' => 'col-lg-12'
    ])

    @php
        $status = array(
            'CREATED' => 'CREADO',
            'PAYED' => 'PAGADO',
            'REJECTED' => 'RECHAZADO'
        );

        $class_status = array(
            'CREATED' => 'bg-info',
            'PAYED' => 'bg-success',
            'REJECTED' => 'bg-danger'
        );
    @endphp

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        {!! Form::text('id', $order->id, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled'
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        {!! Form::text('name', $order->customer_name, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        {!! Form::text('brand', $order->customer_email, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        {!! Form::text('price', $order->customer_mobile, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>

                                        {!! Form::text('brand', $status[$order->status], [
                                            'class' => $class_status[$order->status] . ' form-control pl-3 pr-3',
                                            'disabled',
                                            'style' => 'color: white;'
                                        ]) !!}
                                    </div>
                                </div>

                                @include('layouts.shows.dates', [
                                    'created_at' => $order->created_at,
                                    'updated_at' => $order->updated_at,
                                ])
                            </div>
                            <div class="col-12 col-md-4">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection()
