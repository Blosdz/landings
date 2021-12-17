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
                             @include('payments.table2')

                              <img src="{{ asset('welcome/images/pago.png') }}" alt="" data-position="center center" class="center-img"/>
                         </div>
                         
                         
                         
                         <a href="{{ route('payments.pay') }}" class="btn btn-primary">Hacer deposito</a>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

