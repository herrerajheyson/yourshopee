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
        <div class="row">
            @foreach ($products as $item)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-5">
                    <div class="card" style="width: 18rem;">
                        <h5 class="card-header">Categoría(s): {!!implode('|', $item->categories()->pluck('name')->toArray())!!}</h5>
                        <img src="{{ asset('argon') }}/img/products/{!!$item->image!!}" class="card-img-top image-store" alt="...">
                        <div class="card-body pt-0">
                            <p class="card-title">
                                <h6>{!!$item->brand!!}</h6>
                                <h4>{!!$item->name!!}</h4>
                                <h6>{!!$item->reference!!}</h6>
                                <h2><span class="badge badge-success">-{!!$item->discount!!}%</span> <strong>{!!'$ ' . number_format($item->price, 2)!!}</strong></h2>
                                <p class="card-text" style="font-size: 14px;">{!!$item->description!!}</p>
                            </p>
                            <span style="display: inline-flex;">
                                {!! Form::number('amount', 0, [
                                    'class' => 'form-control mr-2',
                                    'min' => 0,
                                    'max' => $item->amount
                                ]) !!}
                                <a href="#" class="btn btn-primary">Lo Quiero!</a>
                                <h2>
                                    <span class="badge badge-warning">{!!$item->amount!!} Ud</span>
                                </h2>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <span class="custom-pagination">
            {!!$products->render()!!}
        </span>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
