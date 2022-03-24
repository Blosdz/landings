<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Cargar foto de DNI frontal:') !!}
    <p>{!! Form::file('file', ['required'=>'required', 'accept'=>'image/*']) !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dni_r', 'Cargar foto de DNI posterior:') !!}
    <p>{!! Form::file('file_r', ['required'=>'required', 'accept'=>'image/*']) !!}</p>
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

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Number Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
    {!! Form::text('identification_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
    {!! Form::select('country_document', $countries, $profile->country_document, ['class' => 'form-control','autocomplete'=>'off']) !!}
    <!-- {!! Form::label('number_document', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(mb_substr($profile->country_document ,0, 2), ENT_QUOTES, 'UTF-8'))) !!}-->
    <!-- {!! Form::select('country_document', $countries, Str::upper(strtr(utf8_decode(mb_substr($profile->country_document ,0, 2)), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'),'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY')),['class' => 'form-control','autocomplete'=>'off']) !!}-->
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sex', 'Sexo:') !!}
    {!! Form::select('sex', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6" style="display: none;">
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
    <div class="form-group col-sm-3">
        {!! Form::label('country', 'País:') !!}
        {!! Form::select('country', $countries, $profile->country, ['class' => 'form-control', 'style' => 'width: 180px; ','autocomplete'=>'off']) !!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('city', 'Región:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
    </div>
</div>



<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección de residencia:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Carga una foto de perfil:') !!}
    <p>{!! Form::file('profile_picture', ['required'=>'required', 'accept'=>'image/*']) !!}</p>
</div>

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('photo', 'Foto de perfil:') !!}
    <p>{!! Form::file('photo', ['accept'=>'image/*']) !!}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
    {!! Form::text('address_wallet', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check1" id="check1" class="checks"> Acepto declaración jurada</label>
</div>
<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check2" id="check2" class="checks"> Acepto contrato</label>
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
        
        $('.checks').change(function(){
            $('#btn-send').prop('disabled', true);
            if ( $('#check1').is(':checked') && $('#check2').is(':checked') ) {
                $('#btn-send').prop('disabled', false);
            }
        });
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