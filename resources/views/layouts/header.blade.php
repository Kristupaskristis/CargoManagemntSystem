<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
            <img src="{{ asset('img/terminalas1.png') }}" alt="logo" />
        </a>

        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">


                <img src="{{ url('img/Ticon.ico') }}"/>

        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text d-none d-md-inline-flex">{{ Auth::user()->email}}</span>
                    <!--
                        Profile icon. Evaldas 2021-05-07
                        <img class="img-xs rounded-circle" src="{{ url('assets/images/faces/face8.jpg') }}" alt="Profile image">
                    -->
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    @role('admin')
                        <a class="dropdown-item mt-2" href="{{ url('/users') }}">Vartotojai</a>
                    @endrole

                    <a class="dropdown-item" href="{{ url('/profile') }}">Koreguoti profilį</a>

                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Atsijungti
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu icon-menu"></span>
        </button>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</nav>
