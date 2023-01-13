@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Depositos</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        Selecciona tu plan
                        <a href="{{route('payment.plan')}}" class="btn btn-danger float-right"> Escoger otro plan</a>
                    </div>
                    <div class="card-body row">
                        <div class="card mx-5 p-3 w-25" style="background-color: #1c2a5b; color:white">
                            <span>
                                <h1 class="float-left">{{$plan->name}}</h1> 
                                <img class="card-img-top float-right" style ="width: 15%" src="/welcome_new/images/icons/{{$plan->logo}}" alt="Card image cap">
                                &nbsp;
                            </span>
                            <div class="card-body text-center">
                                <p class="card-text mt-4 text-left"> Deposito permitido desde: </p>
                                <p><h1 class="" style="color: #eab226"><b>${{$plan->minimum_fee}} a {{$plan->maximum_fee?'$'.$plan->maximum_fee:"más"}}</b></h1></p>
                                <p class="text-left"><b>Membresía: </b> ${{$plan->annual_membership}}/Anual</p>
                                <p class="text-left"><b>Comisión: </b> {{$plan->commission}}%</p>
                                <p>"La comisión se ejecuta sobre la ganancia y se realiza al finalizar el ciclo de inversión"</p>
                            </div>
                        </div>
                        <div class="card mx-5 p-3 w-50">
                            <p class="text-center">Complete el formulario para adquirir el plan escogido.</p>
                            {!! Form::open(['route' => 'client.payment','class'=>'py-3','id'=>'pay-form']) !!}
                                <div class="row">    
                                    <div class="col-3"></div>
                                        <div class="form-group col-sm-6 mb-5">
                                            {!! Form::label('mount', 'Monto a depositar*:') !!}
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                {!! Form::number('mount', null, ['class' => 'form-control','min'=>$plan->minimum_fee,'max'=>$plan->maximum_fee,'required','placeholder'=>$plan->minimum_fee,'step'=>0.01,'id'=>'amount-input']) !!}
                                            </div>
                                        </div>
                                </div>
                                <div class="row">    
                                    <div class="col-3"></div>
                                        <div class="form-group col-sm-6 mb-5">
                                            {!! Form::label('code', 'Código de suscriptor o cliente:') !!}
                                            {!! Form::text('code', null, ['class' => 'form-control','placeholder'=>'ABC123']) !!}
                                        </div>
                                        {!! Form::hidden('plan_id', $plan->id, []) !!}
                                </div>

                                <div class="row d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-xl p-2" data-toggle="modal" data-target="#exampleModal" id="modal-btn">
                                        <h3>¡Depositar ahora!</h3>
                                    </button>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <p class="text-center">
                                                Escanea el QR de nuestro Binance Pay y realiza el pago por el monto de: $<span id="amount">0.00</span> USD.
                                            </p>
                                            <img class="w-100" src="/images/BINANCE-PAY.jpeg" alt="Binance pay">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            {!! Form::submit('Ya realicé el pago', ['class'=>'btn btn-success']) !!}
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#modal-btn").click(function(){
        var $myForm = $('#pay-form');

        if (!$myForm[0].checkValidity()) {
            $myForm.find(':submit').click();
            return false;
        }

        $("#amount").html(parseFloat($("#amount-input").val()).toFixed(2));
    })
</script>

@endsection