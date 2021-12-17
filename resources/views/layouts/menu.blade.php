@php
    $user = Auth::user();

    $badge = '<span class="badge badge-success" style="float: left;">Validado</span>';
    if( $user->rol == 2 ) {
        if($user->validated == 0) {
            $badge = '<span class="badge badge-warning" style="float: left;">En Validacion</span>';
        }
    }
@endphp

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
        <span>Documentos Generales</span>
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

@php
  }
  if( $user->rol == 3 ) {
@endphp

@php
  }
@endphp

