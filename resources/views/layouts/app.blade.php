@php
    $user = Auth::user();
    $profile = Auth::user()->with('profile')->first(); 
    $profile = $profile->profile->where('user_id', $user->id)->first();
    //dd($user, $profile);
    //dd($user->rol);

    $badge = '<span class="badge badge-success" style="float: left;">Validado</span>';
    
    $session_validate = 5;
    if( $user->rol == 2 ) {
        if($user->validated == 0) {
            $badge = '<span class="badge badge-warning" style="float: left;">En Validacion</span>';
        }
        $session_validate = $profile->verified;
    }
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <script src="{{ url('/countries.js') }}"></script>

    <!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
@stack('scripts')

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('welcome/images/logo.png') }}" width="80" height="80"
             alt="InfyOm Logo">
        <img class="navbar-brand-minimized" src="{{ asset('welcome/images/logo.png') }}" width="30"
             height="30" alt="InfyOm Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Cuenta</strong>
                </div>
                <a class="dropdown-item" href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i>Cerrar Session
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>

<div class="app-body">
    @include('layouts.sidebar')
    <main class="main">
    @php
        if( !$user->email_verified_at) {
    @endphp
        <div class="alert alert-info" role="alert">
            Confirme su correo electronico en el correo de registro enviado
        </div>
    @php
        }
    @endphp

    @php
        if( $session_validate == 0) {
    @endphp
        <div class="alert alert-danger" role="alert">
            Complete su informacion de perfil para continuar operando! &nbsp;
            <a class="btn btn-danger" href="{{ route('profiles.user') }}">
                <span>Verificacion</span>
            </a>
        </div>
    @php
        } elseif( $session_validate == 1) {
    @endphp
        <div class="alert alert-warning" role="alert">
            Su informacion ha sido recibida y esta siendo validada.
        </div>
    @php
        } elseif( $session_validate == 3) {
    @endphp
        <div class="alert alert-danger" role="alert">
            Su informacion ha sido rechazada, actualizar su perfil.
            <a class="btn btn-danger" href="{{ route('profiles.user') }}">
                <span>Verificacion</span>
            </a>
        </div>
    @php
        }
    @endphp
        @yield('content')
    </main>
</div>
<footer class="app-footer">
    <div>
        <a href="https://infyom.com">InfyOm </a>
        <span>&copy; 2019 InfyOmLabs.</span>
    </div>
    <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
    </div>
</footer>
</body>


<script>
    $( document ).ready(function() {
        
        function copy(selector){
            var $temp = $("<div>");
            $("body").append($temp);
            $temp.attr("contenteditable", true)
                .html($(selector).html()).select()
                .on("focus", function() { document.execCommand('selectAll',false,null); })
                .focus();
            document.execCommand("copy");
            $temp.remove();
        }
        
        if($('#country_document').length){
            var $html = "";
            for (let index = 0; index < countries.countries.length; index++) {
                console.log(countries.countries[index].name);
                $html += '<option value="'+countries.countries[index].name+'">'+countries.countries[index].name+'</option>';
            }
            //console.log($html);
            $('#country_document').append($html);
            $('#country_document2').append($html);
            $('#country_document3').append($html);
            $('#country').append($html);
            $('#country2').append($html);
            $('#country3').append($html);
        }
    });
</script>
</html>
