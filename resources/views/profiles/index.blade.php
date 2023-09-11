@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Perfiles</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Perfiles a verificar
                         </div>
                         <div class="card-body">
                             @if(auth()->user()->rol !== 5 )
                                 @include('profiles.filters')
                                 @include('profiles.table')
                             @else
                                 @include('profiles.filters2')
                                 @include('profiles.table2')
                             @endif
                              <div class="pull-right mr-3">
                                     
                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

