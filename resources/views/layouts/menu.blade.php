<li class="nav-item {{ Request::is('propietarios*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('propietarios.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Propietarios</span>
    </a>
</li>
<li class="nav-item {{ Request::is('mascotas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('mascotas.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Mascotas</span>
    </a>
</li>
{{--<li class="nav-item {{ Request::is('razas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('razas.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Razas</span>
    </a>
</li>
<li class="nav-item {{ Request::is('sexos*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('sexos.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Sexos</span>
    </a>
</li>--}}
