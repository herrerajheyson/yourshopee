@extends('layouts.app', ['title' => __('Perfil del Usuario')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Hola') . ' '. auth()->user()->name,
    'description' => __('Esta es tu página de perfil. Aquí podrás visualizar la información de tu usuario y administrar los
    cambios que son marcados en el formulario de abajo. Éxitos.'),
    'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @switch(auth()->user()->gender)
                                        @case('F')
                                            @php
                                                $avatar = 'woman.png';
                                            @endphp
                                        @break
                                        @case('M')
                                            @php
                                                $avatar = 'man.png';
                                            @endphp
                                        @break

                                        @default
                                            @php
                                                $avatar = 'user.png';
                                            @endphp
                                    @endswitch
                                    <img src="{{ asset('argon') }}/img/theme/{{ $avatar }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-6">
                                    <div>
                                        <span class="heading">{{$purchases_made}}</span>
                                        <span class="description">{{ __('Compras Realizadas') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{$items_purchased}}</span>
                                        <span class="description">{{ __('Artículos Comprados') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>
                                @if (auth()->user()->address)
                                    {{ auth()->user()->address }}
                                @else
                                    {{ 'Sin dirección registrada' }}
                                @endif
                            </div>
                            <div class="h5 font-weight-300">
                                <i class="ni mobile-button mr-2"></i>
                                @if (auth()->user()->phone)
                                    {{ auth()->user()->phone }}
                                @else
                                    {{ 'Sin Información teléfonica' }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Editar Perfil') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nombres') }}</label>
                                    <input type="text" name="name" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Nombres') }}"
                                        value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email"
                                        class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Email') }}"
                                        value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Genero') }}</label>
                                    <select class="form-control" name="gender" id="gender" required>
                                        @php
                                            $gender = old('gender', auth()->user()->gender);
                                        @endphp
                                        <option value="F" @if ($gender == 'F') {{ 'selected' }} @endif>Femenino</option>
                                        <option value="M" @if ($gender == 'M') {{ 'selected' }} @endif>Masculino</option>
                                        <option value="NA" @if ($gender == 'NA') {{ 'selected' }} @endif>No Aplica</option>
                                    </select>

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Dirección') }}</label>
                                    <input type="text" name="address" id="input-address"
                                        class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('... Cr 5 N23-4, Santa Marta, Colombia') }}"
                                        value="{{ old('address', auth()->user()->address) }}">

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Teléfono') }}</label>
                                    <input type="text" name="phone" id="input-phone"
                                        class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('3103456789') }}"
                                        value="{{ old('phone', auth()->user()->phone) }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Contraseña') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                        for="input-current-password">{{ __('Contraseña Actual') }}</label>
                                    <input type="password" name="old_password" id="input-current-password"
                                        class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Contraseña Actual') }}" value="" required>

                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                        for="input-password">{{ __('Nueva Contraseña') }}</label>
                                    <input type="password" name="password" id="input-password"
                                        class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Nueva Contraseña') }}" value="" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-password-confirmation">{{ __('Confirmar Nueva Contraseña') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Confirmar Nueva Contraseña') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-success mt-4">{{ __('Cambiar Contraseña') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
