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
        'description' => __('Bienvenido(a) a tu <strong style="font-size: 26px;">tienda en línea</strong> preferida, en <strong
            style="font-size: 26px;">Your Shopee</strong> encontrarás lo que buscas justo como lo necesitas. No te pierdas la
        oportunidad y aprovecha nuestras promociones y precios, <strong style="font-size: 26px;">¡Están Increibles!</strong>
        Adelante...'),
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
        <div class="row">
            @foreach ($products as $item)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-5">
                    <div class="card" style="width: 18rem;">
                        <h5 class="card-header">Categoría(s): {!! implode('|', $item->categories()->pluck('name')->toArray()) !!}</h5>
                        <img src="{{ asset('argon') }}/img/products/{!! $item->image !!}"
                            class="card-img-top image-store" alt="...">
                        <div class="card-body pt-0">
                            <p class="card-title">
                                <h6>{!! $item->brand !!}</h6>
                                <h4>{!! $item->name !!}</h4>
                                <h6>{!! $item->reference !!}</h6>
                                <h2>
                                    <span class="badge badge-success">-{!! $item->discount !!}%</span>
                                    <strong>{!! '$ ' . number_format($item->price, 2) !!}</strong>
                                </h2>
                                <p class="card-text" style="font-size: 14px;">{!! $item->description !!}</p>
                            </p>
                            <span>
                                {{ Form::open(['url' => route('addtocar'), 'method' => 'POST', 'role' => 'form', 'style' => 'display: inline-flex']) }}
                                    {!! Form::number('amount', 1, [
                                        'class' => 'form-control mr-2',
                                        'min' => 0,
                                        'max' => $item->amount,
                                    ]) !!}
                                    {!! Form::hidden('sku', $item->sku) !!}
                                    {!! Form::hidden('name', $item->name) !!}
                                    {!! Form::submit(__('Lo Quiero!'), ['class' => 'btn btn-primary']) !!}
                                    <h2>
                                        <span class="badge badge-warning">{!! $item->amount !!} Ud</span>
                                    </h2>
                                {!! Form::close() !!}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <span class="custom-pagination">
            {!! $products->render() !!}
        </span>

        @if (!$product_amount)
            @php $product_amount = null; @endphp
        @endif

        @include('layouts.buttoncar', [
            'amount' => Session::has('product_amount') ? Session::get('product_amount') : $product_amount
        ])

        @include('layouts.footers.auth')
    </div>
@endsection
