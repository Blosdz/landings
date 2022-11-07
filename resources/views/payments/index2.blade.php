@php
    $user = Auth::user();
@endphp

@extends('layouts.app')

<style>
    .center-img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>

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
                             Depositos
                         </div>
                         <div class="card-body">
                         @php
                            if($user->validated) {
                        @endphp

                            @if($current)
                                @include('payments.table2')
                            @else
                            

                              <img src="/images/binance-banner.jpg" alt="" data-position="center center" class="center-img py-4" data-toggle="modal" data-target="#exampleModal" id=""/>

                              <div class="row d-flex justify-content-center">
                                    <button type="button" class="btn btn-outline-primary btn-xl p-2" data-toggle="modal" data-target="#exampleModal" id="modal-btn">
                                        <h3>¡Depositar ahora!</h3>
                                    </button>
                                </div>
                                <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                </div-->
                              <a href="{{ route('payments.pay') }}" class="btn btn-primary lg-12">Hacer deposito</a>
                            @endif
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
    </div>
    <script>
        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        var nonce = makeid(32);
        var timestamp = Math.floor(new Date().getTime()/1000);
        var body = '{"env" : {"terminalType": "APP"},"merchantTradeNo": "9825382937292","orderAmount": 25.17,"currency": "BUSD","goods" :{"goodsType": "01","goodsCategory": "D000","referenceGoodsId": "7876763A3B","goodsName": "Ice Cream","goodsDetail": "Greentea ice cream cone"}}';

        $('#modal-btn').click(function(event) {
            console.log(event.timestamp);
            $data = {
                /*"name": $("#name").val(),
                "mail": $("#mail").val(),
                "phone": $("#phone").val(),
                "category": $("#category").val(),
                "_token": $("#_token").val()*/
                "_token": "<?php echo csrf_token(); ?>"
            };
            $.ajax({
                type: "POST",
                url: "{{ route('payment.order') }}",
                data: $data,
                success: function (data){
                    console.log("success:", data);
                },
                dataType: "json"
            });

            alert("Prueba");

            event.preventDefault();

            })
        </script>
@endsection
