
@auth()
    @include('layouts.navbars.sidebars.auth')
@endauth

@guest()
    @include('layouts.navbars.sidebars.guest')
@endguest
