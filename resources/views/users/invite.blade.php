@extends('layouts.app')

@section('content')

@php
    $codigo = explode("@", $user->email)[0];
    if($user->link != ''){
        $codigo = $user->link;
    }
@endphp
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Invitar</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Invita a clientes
                         </div>
                         <div class="card-body">
                        
                        @php
                            if($user->validated) {
                        @endphp

                            <p>
                            Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                            </p>

                            {!! Form::model($user, ['route' => ['users.link'], 'method' => 'post', 'onsubmit'=>"return confirm('Una vez confirmado no podra cambiar su codigo de invitacion');"]) !!}

                            <div class="form-group col-sm-6">
                                {!! Form::label('link', 'Tu codigo:') !!}
                                {!! Form::text('link', $codigo, ['class' => 'form-control']) !!}
                            </div>
                            
                            <p id="url_shared">
                                <h3>{{ env('APP_URL') }}/suscriptor/<span style="color: #EAB226; font-size: 32px;">{{$codigo}}</span></h3>
                            </p>

                            <!-- Submit Field -->
                            <div class="form-group col-sm-12">
                            @php
                                if(!$user->link){
                            @endphp
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!} 
                            @php        
                                }
                            @endphp
                                
                            </div>

                            {!! Form::close() !!}

                         </div>

                        @php
                            } else {
                        @endphp
                            <div class="alert alert-danger" role="alert">
                                No tiene habilitado esta accion hasta que su cuenta se validada
                            </div>
                        @php
                            }
                        @endphp
                     </div>
                  </div>
             </div>
         </div>
    </div>


@endsection


