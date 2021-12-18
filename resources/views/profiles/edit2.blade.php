@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('profiles.index') !!}">Perfil</a>
          </li>
          <li class="breadcrumb-item active">Verifica</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
            @include('flash::message')
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Verifica tu informacion</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($profile, ['route' => ['profiles.update2', $profile->id], 'method' => 'post']) !!}

                              @include('profiles.fields2')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection