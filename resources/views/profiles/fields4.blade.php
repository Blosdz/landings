<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Dni Frontal:') !!}
    <p>{!! Form::file('file3') !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Dni Reverso:') !!}
    <p>{!! Form::file('file3_r') !!}</p>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres:') !!}
    {!! Form::text('first_name3', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos:') !!}
    {!! Form::text('lastname3', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document3', 'País emisor del documento de identidad:') !!}
    {!! Form::select('country_document3', [], null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::select('type_document3', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
    {!! Form::date('birthdate3', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionality Field -->

<div class="form-group col-sm-6">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    {!! Form::text('nacionality3', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel3', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('country3', 'Pais:') !!}
        {!! Form::select('country3', [], null, ['class' => 'form-control', 'style' => 'width: 180px; ','empty'=>'Seleccionar']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('city', 'Region:') !!}
        {!! Form::text('city3', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state3', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección de recidencia:') !!}
    {!! Form::text('address3', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone3', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job3', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary']) !!}
</div>

