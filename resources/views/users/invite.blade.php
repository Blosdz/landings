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
                            <div class="p-2 w-50 text-center mx-auto">  
                                <p style="font-size: 3vh"> Invita a futuros inversionistas.<br>
                                    Tenemos bonos para tí.
                                </p>
                            </div>
                            <div class="p-2 w-50 text-center mx-auto">  
                                <p>
                                    Invita a inversionistas como clientes de AEIA con tu código suscriptor. Recuerda que tenemos bonos para ti. Para saber todos los beneficios como suscriptor puedes verlos aquí.
                                </p>
                            </div>
                            {!! Form::model($user, ['route' => ['users.link'], 'method' => 'post', 'onsubmit'=>"return confirm('Una vez confirmado no podrá cambiar su código de invitación nuevamente.');"]) !!}

                            <div class="form-group col-sm-12 text-center">
                                {!! Form::label('link', 'Tu codigo:',['class'=>'p-2 w-50 mx-auto text-left']) !!}
                                {!! Form::text('link', $codigo, ['class' => 'form-control p-2 w-50 mx-auto','disabled'=>($user->link?true:false)]) !!}
                            </div>
                            <div class="p-2 w-50 text-center mx-auto">
                                <p id="url_shared">
                                    <h3>{{ env('APP_URL') }}/suscriptor/<span style="color: #EAB226; font-size: 32px;">{{$codigo}}</span></h3>
                                </p>
                            </div>

                            <!-- Submit Field -->
                            <div class="form-group col-sm-12">
                            @if (!$user->link)
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!} 
                            @else
                                <div class="row p-2 w-50 mx-auto">
                                    {!! Form::text('emails','El correo electrónico de tus inversionistas (separado por comas)' , ['class' => 'form-control col-10']) !!}
                                    {!! Form::submit('Invitar', ['class' => 'btn btn-success col-2']) !!} 
                                </div>
                            @endif                                
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


