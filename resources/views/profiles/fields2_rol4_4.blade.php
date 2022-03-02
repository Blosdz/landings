<!-- Dni Field -->
<div class="form-group col-sm-6">
    <img src="{{ url('/storage', $profile->dni) }}" width="300px"/>
    <img src="{{ url('/storage', $profile->dni_r) }}" width="300px"/>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
    {!! Form::select('country_document', [], null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
    {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionality Field -->

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    {!! Form::text('nacionality', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('country', 'Pais:') !!}
        {!! Form::select('country', [], null, ['class' => 'form-control', 'style' => 'width: 180px; ','empty'=>'Seleccionar']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('city', 'Region:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sex', 'Sexo:') !!}
    {!! Form::select('sex', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección fiscal o residencia:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Foto de perfil:') !!}
    <img src="{{ url('/storage', $profile->id) }}" width="300px"/>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('id_taxes', 'Id taxes:') !!}
    {!! Form::text('id_taxes', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('business_name', 'Nombre de empresa:') !!}
    {!! Form::text('business_name', null, ['class' => 'form-control']) !!}
</div>
@php
    $url = url('/storage/workers', $profile->id);
    $file_name = 'Descargar archivo';
@endphp
<div class="form-group col-sm-6">
    {!! Form::label('partners', 'Registro de socios :') !!}
    <p>
        <a href="{{ $url }}"  class='btn btn-ghost-info' download>
            {{$file_name}} <i class="fa fa-download"></i>
        </a>
    </p>
</div>
        

<div class="form-group col-sm-6">
    {!! Form::label('bank_account', 'Cuenta bancaria actualizada:') !!}
    {!! Form::text('bank_account', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('wallet_account', 'Cuenta wallet actualizada:') !!}
    {!! Form::text('wallet_account', null, ['class' => 'form-control']) !!}
</div>




<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>

