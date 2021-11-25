@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
    'title' => __('Producto: ') . $product->name,
    'description' => __('A continuación podrás ver toda la información que corresponde al registro seleccionado.'),
    'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        {!! Form::text('sku', $product->sku, [
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
                                        {!! Form::text('name', $product->name, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                        </div>
                                        {!! Form::text('brand', $product->brand, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                        </div>
                                        {!! Form::text('categories', implode(', ', $product->categories()->pluck('name')->toArray()), [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni fa fa-dollar-sign"></i></span>
                                        </div>
                                        {!! Form::text('price', $product->price, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni fa fa-sort-amount-up"></i></span>
                                        </div>
                                        {!! Form::number('amount', $product->amount, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled'
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni fa fa-percent"></i></span>
                                        </div>
                                        {!! Form::number('discount', $product->discount, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled'
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-bold"></i></span>
                                        </div>
                                        {!! Form::text('reference', $product->reference, [
                                            'class' => 'form-control pl-3 pr-3',
                                            'disabled'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <output id="list">
                                    <img class="img-fluid img-thumbnail rounded-lg" src="{{ asset('argon') }}/img/products/{{$product->image}}" alt="Imagen de Referencia">
                                </output>
                                <br>
                                <div class="form-group">
                                    <p>Descripción:</p>
                                    {!! Form::label('description', $product->description, [
                                        'class' => 'form-label',
                                        'style' => 'font-size: 14px;'
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        @include('layouts.shows.dates', [
                            'created_at' => $product->created_at,
                            'updated_at' => $product->updated_at,
                        ])
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection
