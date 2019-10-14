<!-- Nombres Field -->
<div class="form-group">
    {!! Form::label('nombres', 'Nombres:') !!}
    <p>{!! $propietario->nombres !!}</p>
</div>

<!-- Apellidos Field -->
<div class="form-group">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    <p>{!! $propietario->apellidos !!}</p>
</div>

<!-- Direccion Field -->
<div class="form-group">
    {!! Form::label('direccion', 'Direccion:') !!}
    <p>{!! $propietario->direccion !!}</p>
</div>

<!-- Telefono Field -->
<div class="form-group">
    {!! Form::label('telefono', 'Telefono:') !!}
    <p>{!! $propietario->telefono !!}</p>
</div>

<!-- Correo Field -->
<div class="form-group">
    {!! Form::label('correo', 'Correo:') !!}
    <p>{!! $propietario->correo !!}</p>
</div>

{!! Form::label('Mascotas', 'Mascotas:') !!}
@foreach($propietario->mascotas as $mascota)

    <a href="/mascotas/{{$mascota->cod_expediente}}"><p>--{{$mascota->nombre}}</p></a>

@endforeach

<!-- Mascotas -->


