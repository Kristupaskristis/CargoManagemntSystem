<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ active_class(['dashboard']) }}">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Pagrindinis</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['cargoes/arrival']) }}">
            <a class="nav-link" href="{{ url('/cargoes/arrival') }}">
                <i class="menu-icon mdi mdi-truck-delivery"></i>
                <span class="menu-title">Atvykimas</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['cargoes/departure']) }}">
            <a class="nav-link" href="{{ url('/cargoes/departure') }}">
                <i class="menu-icon mdi mdi-truck-fast"></i>
                <span class="menu-title">Išvykimas</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['cargoes/terminal']) }}">
            <a class="nav-link" href="{{ url('/cargoes/terminal') }}">
                <i class="menu-icon mdi mdi-warehouse"></i>
                <span class="menu-title">Terminalas</span>
            </a>
        </li>
        @role('admin')
        <li class="nav-item {{ active_class(['clients']) }}">
            <a class="nav-link" href="{{ url('/clients') }}">
                <i class="menu-icon mdi mdi-account-group"></i>
                <span class="menu-title">Klientai</span>
            </a>
        </li>
        @endrole
        <li class="nav-item {{ active_class(['cargoes/history']) }}">
            <a class="nav-link" href="{{ url('/cargoes/history') }}">
                <i class="menu-icon mdi mdi-history"></i>
                <span class="menu-title">Istorija</span>
            </a>
        </li>
    </ul>
</nav>
