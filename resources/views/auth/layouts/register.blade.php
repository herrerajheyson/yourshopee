@if (isset($title) && $title)
    <div class="text-center text-muted mb-4">
        <small>
            Por favor, llena todos los campos a continuación.
        </small>
    </div>
@endif
<form role="form" method="POST" action="{{ $route }}">
    @csrf

    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Nombres') }}" type="text" name="name"
                value="{{ old('name') }}" required autofocus>
        </div>
        @if ($errors->has('name'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
            </div>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Email') }}" type="email" name="email"
                value="{{ old('email') }}" required>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input type="text" name="phone" id="input-phone"
                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                placeholder="{{ __('3103456789') }}"
                value="{{ old('phone') }}" required>
        </div>
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    @if (isset($title) && $title)
        <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                </div>
                <select class="form-control" name="gender" id="gender">
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                    <option value="NA">No Aplica</option>
                </select>
            </div>
            @if ($errors->has('gender'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
        </div>
    @endif

    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Contraseña') }}" type="password" name="password" required>
        </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control" placeholder="{{ __('Confirmar Contraseña') }}"
                type="password" name="password_confirmation" required>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-12">
            <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id="customCheckRegister" type="checkbox"
                    required>
                <label class="custom-control-label" for="customCheckRegister">
                    <span class="text-muted">{{ __('Estoy de acuerdo con la') }}
                        <a href="{{ asset('argon') }}/documents/política de privacidad.pdf"
                            target="_blank">{{ __('política de privacidad') }}</a>
                    </span>
                </label>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">{{ __('Registrarse') }}</button>
    </div>
</form>
