@extends('layouts.app')

@section('content')
   

     <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('profiles.index') }}">Perfiles a verificar</a>
      </li>
      
    </ol>


    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             historial de rechazo
                         </div>
                         <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped" id="events-table">
                                        <thead>
                                            <tr>
                                        <th>Nombre</th>
                                        <th>Comentario</th>
                                        <th>Fecha</th>
                                                        <th colspan="3">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        @if( !empty($user))
                                            @foreach($user as $u)
                                                <tr>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->comment }}</td>
                                                <td>{{ $u->date }}</td>

                                                <td>
                                                    {!! Form::open(['route' => ['DeleteRejectionHistory', $u->id], 'method' => 'delete']) !!}
                                                    <div class='btn-group'>
                                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                        


                                        </tbody>
                                    </table>
                                </div>
                              <div class="pull-right mr-3">
                                     
                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection




