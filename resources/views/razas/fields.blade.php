<!-- Raza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('raza', 'Raza:') !!}
    {!! Form::text('raza', null, ['class' => 'form-control']) !!}
</div>

<!-- Cod Especie Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_especie', 'Cod Especie:') !!}
    {!! Form::number('cod_especie', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('razas.index') !!}" class="btn btn-default">Cancel</a>
</div>
