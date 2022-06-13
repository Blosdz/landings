@extends('layouts.app')

@section('content')
<?php 
    $status = [
        0 => 'En validación',
        1 => 'Aprobado',
        2 => 'Rechazado'
];
?>
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('payments.index') }}">Depósitos</a>
            </li>
            <li class="breadcrumb-item active">Detalle</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalles</strong>
                                  <a href="{{ route('clients.index') }}" class="btn btn-danger float-right">Regresar</a>
                             </div>
                             <div class="card-body">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Estado:</th>
                                            <td>{{$status[$payment->client_payment->status]}}</td>
                                        </tr>
                                        <tr>
                                            <th>Código:</th>
                                            <td>{{$payment->client_payment->code}}</td>
                                        </tr>
                                        <tr>
                                            <th>Plan:</th>
                                            <td>{{$payment->client_payment->plan->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fondo:</th>
                                            <td>{{$payment->month}}/{{$payment->date_transaction->format('Y')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>$ {{$payment->total}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de transacción:</th>
                                            <td>{{$payment->date_transaction}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de cierre:</th>
                                            <td>{{$payment->date_transaction->modify('+1 day')->modify('+1 year')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Codigo referido:</th>
                                            <td>{{$payment->client_payment->referred_code}}</td>
                                        </tr>
                                        @if ($payment->client_payment->referred_user)
                                            <th>Usuario:</th>
                                            <td>{{$payment->client_payment->referred_user->name}}                                            
                                        @endif
                                    </tbody>
                                </table>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
