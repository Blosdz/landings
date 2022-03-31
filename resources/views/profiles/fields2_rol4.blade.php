<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Cargar foto de DNI frontal del representante legal:') !!}
    <p>{!! Form::file('dni', ['required'=>'required', 'accept'=>'image/*']) !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dni_r', 'Cargar foto de DNI posterior del representante legal:') !!}
    <p>{!! Form::file('dni_r', ['required'=>'required', 'accept'=>'image/*']) !!}</p>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres del representante legal:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => '30']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos del representante legal:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control','maxlength' => '30']) !!}
</div>

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad del representante legal:') !!}
    {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Number Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_document', 'Número de documento de indentidad del representante legal:') !!}
    {!! Form::text('identification_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document', 'País emisor del documento de identidad del representante legal:') !!}
    {!! Form::select('country_document',[], null, ['class' => 'form-control','autocomplete'=>'off']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Fecha de nacimiento del representante legal:') !!}
    {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('country', 'País:') !!}
        {!! Form::select('country',[], null, ['class' => 'form-control client_country', 'style' => 'width: 180px; ','autocomplete'=>'off']) !!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('city', 'Región:') !!}
        {!! Form::text('city', null, ['class' => 'form-control','maxlength' => '20']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state', null, ['class' => 'form-control','maxlength' => '20']) !!}
    </div>
</div>
<br>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Acta de constitución de la empresa:') !!}
    <p>{!! Form::file('business_file', ['required'=>'required']) !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Vigencia de poderes no mayor a 3 meses:') !!}
    <p>{!! Form::file('power_file', ['required'=>'required']) !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Ficha de ruc o ID Taxes:') !!}
    <p>{!! Form::file('taxes_file', ['required'=>'required']) !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
    {!! Form::text('address_wallet', null, ['class' => 'form-control','maxlength' => '100']) !!}
</div>

<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check1"  id="check1" class="checks"> Acepto declaración jurada</label>
</div>
<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check2"  id="check2" class="checks"> Acepto contrato</label>
</div>
<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check3"  id="check3" class="checks"> Declaración OFAQ </label>
</div>
<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check4"  id="check4" class="checks"> Declaración de no estar expuesto políticamente </label>
</div>
<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check5"  id="check5" class="checks"> Declaración de fondos</label>
</div>



<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary', 'id'=>'btn-send']) !!}
</div>

<script>
    $( document ).ready(function() {
        
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
