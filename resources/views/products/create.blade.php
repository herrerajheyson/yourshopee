@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
    'title' => __('Crear Producto'),
    'description' => __('Llena a continuación todos los campos que se encuentran en el formulario de siguiente.'),
    'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-body px-lg-5 py-lg-5">
                        {{ Form::open([
                            'url' => route('products.store'),
                            'method' => 'POST',
                            'role' => 'form',
                            'enctype' => 'multipart/form-data'
                        ]) }}
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('sku') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                </div>
                                {!! Form::text('sku', old('sku'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('sku') ? ' is-invalid' : ''),
                                    'placeholder' => __('SKU'),
                                    'required',
                                    'autofocus',
                                ]) !!}
                            </div>
                            @if ($errors->has('sku'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('sku') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                {!! Form::text('name', old('name'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('name') ? ' is-invalid' : ''),
                                    'placeholder' => __('Nombre'),
                                    'required',
                                ]) !!}
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                </div>
                                {!! Form::text('brand', old('brand'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('brand') ? ' is-invalid' : ''),
                                    'placeholder' => __('Marca'),
                                    'required',
                                ]) !!}
                            </div>
                            @if ($errors->has('brand'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('brand') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('categories') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3" style="min-height: 180px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                                </div>
                                {!! Form::select('categories[]', $categories, old('categories'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('categories') ? ' is-invalid' : ''),
                                    'required',
                                    'id' => 'categories',
                                    'multiple'
                                ]) !!}
                            </div>
                            @if ($errors->has('categories'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('categories') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni fa fa-dollar-sign"></i></span>
                                </div>
                                {!! Form::number('price', old('price'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('price') ? ' is-invalid' : ''),
                                    'placeholder' => __('Precio'),
                                    'required',
                                    'min' => 0,
                                ]) !!}
                            </div>
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni fa fa-sort-amount-up"></i></span>
                                </div>
                                {!! Form::number('amount', old('amount'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('amount') ? ' is-invalid' : ''),
                                    'placeholder' => __('Cantidad'),
                                    'min' => 0,
                                ]) !!}
                            </div>
                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('discount') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni fa fa-percent"></i></span>
                                </div>
                                {!! Form::number('discount', old('discount'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('discount') ? ' is-invalid' : ''),
                                    'placeholder' => __('Descuento'),
                                    'min' => 0,
                                ]) !!}
                            </div>
                            @if ($errors->has('discount'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-bold"></i></span>
                                </div>
                                {!! Form::text('reference', old('reference'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('reference') ? ' is-invalid' : ''),
                                    'placeholder' => __('Referencia'),
                                    'min' => 0,
                                ]) !!}
                            </div>
                            @if ($errors->has('reference'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('reference') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-album-2"></i></span>
                                        </div>
                                        {!! Form::file('image', [
                                            "class" => "form-control-file pl-3 pr-3" . ($errors->has('image') ? ' is-invalid' : ''),
                                            'style' => 'width: 90%; padding-top: 3px;'
                                        ]) !!}
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div id="parent-list" class="col-4">
                                <output id="list">
                                    <img class="img-fluid img-thumbnail rounded-lg" style="width: 100px;" src="{{ asset('argon') }}/img/products/default.png" alt="Imagen de Referencia">
                                </output>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                </div>
                                {!! Form::textarea('description', old('description'), [
                                    'class' => 'form-control pl-3 pr-3' . ($errors->has('description') ? ' is-invalid' : ''),
                                    'placeholder' => __('Descripción'),
                                    'rows' => 3,
                                ]) !!}
                            </div>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center">
                            {!! Form::submit(__('Guardar'), ['class' => 'btn btn-primary mt-4']) !!}
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <script type="module">
            import {loadImageFromOutput} from '/argon/js/utils.js'
            loadImageFromOutput()
        </script>

        @include('layouts.footers.auth')
    </div>

@endsection
