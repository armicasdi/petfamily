<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Nac Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_nac', 'Fecha Nac:') !!}
    {!! Form::text('fecha_nac', null, ['class' => 'form-control','id'=>'fecha_nac']) !!}
</div>

@section('scripts')
   <script type="text/javascript">
           $('#fecha_nac').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endsection

<!-- Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Color', 'Color:') !!}
    {!! Form::text('Color', null, ['class' => 'form-control']) !!}
</div>

<!-- Cod Propietario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_propietario', 'Cod Propietario:') !!}
    {!! Form::number('cod_propietario', null, ['class' => 'form-control']) !!}
</div>

<!-- Cod Sexo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_sexo', 'Cod Sexo:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('cod_sexo', 0) !!}
        {!! Form::checkbox('cod_sexo', '1', null) !!}
    </label>
</div>


<!-- Cod Raza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_raza', 'Cod Raza:') !!}
    {!! Form::number('cod_raza', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mascotas.index') !!}" class="btn btn-default">Cancel</a>
</div>
