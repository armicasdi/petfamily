{!! Form::open(['route' => ['propietarios.destroy', $cod_propietario], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('propietarios.show', $cod_propietario) }}" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('propietarios.edit', $cod_propietario) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
