@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<style>
    .bootstrap-tagsinput .tag {
        background: #09114a;
        border: 1px solid black;
        padding: 0 6px;
        margin-right: 2px;
        color: white;
        border-radius: 4px;
}
</style>
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
                                    Invita a inversionistas como clientes de AEIA con tu código {{$user->rol==3?'cliente':'suscriptor'}}. 
                                    Recuerda que tenemos bonos para ti. Para saber todos los beneficios como {{$user->rol==3?'cliente':'suscriptor'}} puedes verlos aquí.
                                </p>
                            </div>
                            
                            @if (!$user->link)
                                {!! Form::model($user, ['route' => ['users.link'], 'method' => 'post', 'onsubmit'=>"return confirm('Una vez confirmado no podrá cambiar su código de invitación nuevamente.');"]) !!}
                                <div class="form-group col-sm-12 text-center">
                                    {!! Form::label('link', 'Tu codigo:',['class'=>'p-2 w-50 mx-auto text-left']) !!}
                                    {!! Form::text('link', $codigo, ['class' => 'form-control p-2 w-50 mx-auto','disabled'=>($user->link?true:false)]) !!}
                                </div>
                            @else
                                {!!Form::open(['route'=>'invitation','class'=>'row'])!!}
                            @endif
                            <div class="p-2 w-50 text-center mx-auto">
                                <p id="url_shared">
                                    <h3>{{ env('APP_URL') }}/{{$user->rol==3?'cliente':'suscriptor'}}/<span style="color: #EAB226; font-size: 32px;">{{$codigo}}</span></h3>
                                </p>
                            </div>

                            <!-- Submit Field -->
                            <div class="form-group col-sm-12">
                            @if (!$user->link)
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!} 
                            @else
                                <div class="row p-2 w-50 mx-auto">
                                    {!! Form::text('emails',null , ['class' => 'tagsinput','data-role'=>'tagsinput']) !!}
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
<script>
    $('.tagsinput').tagsinput({
        trimValue: true
    });
    $(".tagsinput").parent().children("div").addClass('col-10')
</script>
    
@endsection


