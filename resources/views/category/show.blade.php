@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
    'title' => __('Categoría: ') . $category->name,
    'description' => __('A continuación podrás ver toda la información que corresponde al registro seleccionado.'),
    'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="card shadow">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                {!! Form::text('name', $category->name, [
                                    "class" => "form-control pl-3 pr-3",
                                    "disabled",
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                </div>
                                {!! Form::textarea('description', $category->description, [
                                    "class" => "form-control pl-3 pr-3",
                                    "disabled",
                                    "rows" => 3,
                                ]) !!}
                            </div>
                        </div>
                        @include('layouts.shows.dates', [
                            'created_at' => $category->created_at,
                            'updated_at' => $category->updated_at,
                        ])
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection
