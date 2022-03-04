
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="#">
        {{ $user->name }}
        <br>
        {!! $badge !!}
        <br>
    </a>
</li>

@php
  if( $user->rol == 1 ) {
@endphp

<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Suscriptores y clientes</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Perfiles a verificar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Depositos</span>
    </a>
</li>

<li class="nav-item {{ Request::is('events*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('events.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Eventos</span>
    </a>
</li>

@php
  }
  if( $user->rol == 2 ) {
@endphp

<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Verificacion</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index2') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('invite*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invite.user') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Invitar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>dashboard</span>
    </a>
</li>

@php
  }
  if( $user->rol == 3 ) {
@endphp

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index2') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Verificacion</span>
    </a>
</li>

<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>dashboard</span>
    </a>
</li>


@php
  }
  if( $user->rol == 4 ) {
@endphp

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Verificacion</span>
    </a>
</li>

<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>dashboard</span>
    </a>
</li>

@php
  }
@endphp

<li class="nav-item {{ Request::is('notifications*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('notifications.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Notificaciones</span>
    </a>
</li>


