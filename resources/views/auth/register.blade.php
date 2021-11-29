@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-3 text-center">
                        <img style="width: 60%;" src="{{ asset('argon') }}/img/brand/logo y slogan.png" alt="">
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @include('auth.layouts.register', ['title' => true, 'route' => route('register')])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
