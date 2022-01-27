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
                            if($user->validate) {
                        @endphp
                             @include('payments.table2')

                              <img src="{{ asset('welcome/images/pago.png') }}" alt="" data-position="center center" class="center-img"/>

                              <a href="{{ route('payments.pay') }}" class="btn btn-primary lg-12">Hacer deposito</a>

                        @php
                            } else {
                        @endphp
                            <div class="alert alert-danger" role="alert">
                                No tiene habilitado esta accion hatsa que su cuenta se validada
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
@endsection

