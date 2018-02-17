{!! Form::open(['route' => 'sentry.modules.store', 'method' => 'POST', 'files' => true]) !!}
@include('Sentry.modules.form')
<div class="col-md-12">
    <div class="form-group text-right">
        {!! Form::submit('Guardar Módulo', ['class' => 'btn btn-default btn-sm btn-round']) !!}
    </div>
</div>
{!! Form::close() !!}