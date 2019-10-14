{!! Form::open(['route' => ['razas.destroy', $cod_raza], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('razas.show', $cod_raza) }}" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('razas.edit', $cod_raza) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
