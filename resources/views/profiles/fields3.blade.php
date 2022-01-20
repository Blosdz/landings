<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Dni Frontol:') !!}
    <p>{!! Form::file('file2') !!}</p>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Dni Reverso:') !!}
    <p>{!! Form::file('file2_r') !!}</p>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres:') !!}
    {!! Form::text('first_name2', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos:') !!}
    {!! Form::text('lastname2', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document2', 'País emisor del documento de identidad:') !!}
    {!! Form::select('country_document2', [], null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::select('type_document2', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
    {!! Form::date('birthdate2', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionality Field -->

<div class="form-group col-sm-6">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    {!! Form::text('nacionality2', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel2', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('country2', 'Pais:') !!}
        {!! Form::select('country2', [], null, ['class' => 'form-control', 'style' => 'width: 180px; ','empty'=>'Seleccionar']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('city', 'Region:') !!}
        {!! Form::text('city2', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state2', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección de recidencia:') !!}
    {!! Form::text('address2', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job2', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary']) !!}
</div>

