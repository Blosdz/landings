@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('notifications.index') }}">Notificaciones</a>
            </li>
            <li class="breadcrumb-item active">Detalles</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                  <a href="{{ route('notifications.index') }}" class="btn btn-info">Regresar</a>
                             </div>
                             <div class="card-body">
                                 @include('notifications.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
