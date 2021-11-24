@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
    'title' => __('Crear Categoría'),
    'description' => __('Llena a continuación todos los campos que se encuentran en el formulario de siguiente.'),
    'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-body px-lg-5 py-lg-5">
                        {{ Form::open(array('url' => route('category.store'), 'method' => 'POST', 'role' => 'form')) }}
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    {!! Form::text('name', old('name'), [
                                        "class" => "form-control pl-3 pr-3" . ($errors->has('name') ? ' is-invalid' : ''),
                                        "placeholder" => __('Nombre'),
                                        "required",
                                        "autofocus"
                                    ]) !!}
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                    </div>
                                    {!! Form::textarea('description', old('description'), [
                                        "class" => "form-control pl-3 pr-3" . ($errors->has('description') ? ' is-invalid' : ''),
                                        "placeholder" => __('Descripción'),
                                        "required",
                                        "rows" => 3,
                                    ]) !!}
                                </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-center">
                                {!! Form::submit(__('Guardar'), ["class" => "btn btn-primary mt-4"]) !!}
                            </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection
