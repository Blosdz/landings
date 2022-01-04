@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('profiles.index') !!}">Perfiles</a>
          </li>
          <li class="breadcrumb-item active">Perfil</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Perfile a verificar</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($profile, ['route' => ['profiles.update', $profile->id], 'method' => 'patch']) !!}

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Socio 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Socio 2</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  @include('profiles.fields')
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  @include('profiles.fields_2')
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  @include('profiles.fields_3')
  </div>
</div>
<br>
@php
    $verified_list = [1=>'En validacion', 2=>'Informacion enviada', 3=>'Validado', 4=>'Rechazado'];
@endphp
<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('verified', 'Estado de la Verificacion:') !!}
    {!! Form::select('verified', $verified_list, null, ['class' => 'form-control','empty'=>'Seleccionar una Opcion']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar verificacion', ['class' => 'btn btn-primary']) !!}
</div>

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection