<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/slogan yourshopee.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
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
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/{{ $avatar }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bienvenido!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mi Perfil') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Herramientas') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Actividad') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Soporte') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Cerrar Sesión') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/slogan yourshopee.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Buscar...') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-shop text-primary"></i> {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.myorders') }}">
                        <i class="ni ni-basket text-primary"></i> {{ __('Mis Pedidos') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-categories" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="navbar-categories">
                        <i class="fas fa-th-list" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Categorías') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-categories">
                        <ul id="menu_categories" class="nav nav-sm flex-column">
                        </ul>
                    </div>
                </li>
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-settings" data-toggle="collapse" role="button"
                            aria-controls="navbar-settings">
                            <i class="ni ni-settings-gear-65"></i>
                            <span class="nav-link-text">{{ __('Herramientas') }}</span>
                        </a>

                        <div class="collapse" id="navbar-settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">
                                        <i class="ni ni-single-02 text-primary"></i>{{ __('Gestión de Usuarios') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('category.index') }}">
                                        <i class="ni ni-single-copy-04 text-primary"></i>{{ __('Gestión de Categorías') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.index') }}">
                                        <i class="ni ni-books text-primary"></i>{{ __('Gestión de Productos') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.index') }}">
                                        <i class="ni ni-basket text-primary"></i> {{ __('Gestión de Pedidos') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
            <!-- Divider -->
            <hr class="my-3">
        </div>
    </div>
    <script type="module">
        import {getMaster} from '/argon/js/utils.js'

        getMaster('/api/categories_selector', {}).then((response) => {
            let html_menu_categories = '<li class="nav-item"><a class="nav-link" href="/store/%id_category%">%name_menu%</a></li>'
            let menu_categories = ''
            for (const key in response.data) {
                if (Object.hasOwnProperty.call(response.data, key)) {
                    const element = response.data[key];
                    menu_categories += html_menu_categories.replace('%name_menu%', element).replace('%id_category%', key)
                }
            }

            $('#menu_categories').html(menu_categories)
        })
    </script>
</nav>
