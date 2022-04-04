<!-- Dni Field -->
<div class="form-group col-sm-6">
    <img src="{{ url('/storage', $profile->dni2) }}" width="300px"/>
    <img src="{{ url('/storage', $profile->dni2_r) }}" width="300px"/>
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

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::text('type_document2', null, ['class' => 'form-control']) !!}
</div>

<!-- Number Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
    {!! Form::text('identification_number2', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
    {!! Form::text('country_document2', null, ['class' => 'form-control']) !!}
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sex', 'Sexo:') !!}
    {!! Form::select('sex2', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
    {!! Form::text('birthdate2', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionality Field -->

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    {!! Form::text('nacionality2', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel2', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('country', 'País:') !!}
        {!! Form::text('country2', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('city', 'Región:') !!}
        {!! Form::text('city2', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state2', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección de recidencia:') !!}
    {!! Form::text('address2', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job2', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'foto de perfil:') !!}
    <br>
    <img src="{{ url('/storage', $profile->profile_picture2) }}" width="300px"/>

</div>
<div class="form-group col-sm-6">
    {!! Form::label('address_wallet', 'Dirección Wallet:') !!}
    {!! Form::text('address_wallet2', null, ['class' => 'form-control']) !!}
</div>

