<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Título:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Fecha:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>



<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Link Meet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_meet', 'Link Meet:') !!}
    {!! Form::text('link_meet', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Recording Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_recording', 'Link Grabación:') !!}
    {!! Form::text('link_recording', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
</div>

<script type="text/javascript">

    $('#date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: true,
        icons: {
            up: "icon-arrow-up-circle icons font-2xl",
            down: "icon-arrow-down-circle icons font-2xl"
        },
        sideBySide: true
    })
   // var status_hide = document.getElementById("status_hide");
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
