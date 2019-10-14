<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $mascota->nombre !!}</p>
</div>

<!-- Fecha Nac Field -->
<div class="form-group">
    {!! Form::label('fecha_nac', 'Fecha Nac:') !!}
    <p>{!! $mascota->fecha_nac !!}</p>
</div>

<!-- Color Field -->
<div class="form-group">
    {!! Form::label('Color', 'Color:') !!}
    <p>{!! $mascota->Color !!}</p>
</div>

<!-- Cod Propietario Field -->
<div class="form-group">
    {!! Form::label('cod_propietario', 'Cod Propietario:') !!}
    <p>{!! $mascota->cod_propietario !!}</p>
</div>

<!-- Cod Sexo Field -->
<div class="form-group">
    {!! Form::label('cod_sexo', 'Cod Sexo:') !!}
    <p>{!! $mascota->cod_sexo !!}</p>
</div>

<!-- Cod Raza Field -->
<div class="form-group">
    {!! Form::label('cod_raza', 'Cod Raza:') !!}
    <p>{!! $mascota->cod_raza !!}</p>
</div>

