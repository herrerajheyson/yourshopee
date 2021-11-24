@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
    'title' => __('Usuario: ') . $user->name,
    'description' => __('A continuación podrás ver toda la información que corresponde al usuario seleccionado.'),
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
                                <input class="form-control pl-3 pr-3" type="text" value="{{ $user->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control pl-3 pr-3" type="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                </div>
                                @switch($user->role)
                                    @case('guest')
                                        @php
                                            $role = 'Visitante';
                                        @endphp
                                        @break
                                    @case('admin')
                                        @php
                                            $role = 'Administrador';
                                        @endphp
                                        @break

                                @endswitch
                                <input class="form-control pl-3 pr-3" type="text" value="{{ $role }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                @switch($user->gender)
                                    @case('F')
                                        @php
                                            $gender = 'Femenino';
                                        @endphp
                                        @break
                                    @case('M')
                                        @php
                                            $gender = 'Masculino';
                                        @endphp
                                        @break

                                    @default
                                        @php
                                            $gender = 'No Aplica';
                                        @endphp

                                @endswitch
                                <input class="form-control pl-3 pr-3" type="text" value="{{$gender}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                </div>
                                <input class="form-control pl-3 pr-3" type="text" value="{{ $user->address }}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                </div>
                                <input class="form-control pl-3 pr-3" type="text" value="{{ $user->phone }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection
