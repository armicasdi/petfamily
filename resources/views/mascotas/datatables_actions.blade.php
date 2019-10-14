{!! Form::open(['route' => ['mascotas.destroy', $cod_expediente], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('mascotas.show', $cod_expediente) }}" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('mascotas.edit', $cod_expediente) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
