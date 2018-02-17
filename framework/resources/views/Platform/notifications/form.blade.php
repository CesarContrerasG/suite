<div class="col-md-12">
    <div class="form-group{{ $errors->has('notification_title') ? ' has-error' : '' }}">
        {!! Form::label('notification_title', 'Titulo de la Notificación') !!}
        {!! Form::text('notification_title', null, ['class' => 'form-control']) !!}
        @if ($errors->has('notification_title'))
            <span class="help-block">
                <strong>{{ $errors->first('notification_id') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-12">
    <div class="form-group{{ $errors->has('notification') ? ' has-error' : '' }}">
        {!! Form::label('notification', 'Notificación') !!}
        {!! Form::textarea('notification', null, ['class' => 'form-control ckeditor']) !!}
        @if ($errors->has('notification'))
            <span class="help-block">
                <strong>{{ $errors->first('notification') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has('date_show') ? ' has-error' : '' }}">
        {!! Form::label('date_show', 'Mostrar desde:') !!}
        {!! Form::text('date_show', null, ['class' => 'form-control dates']) !!}
        @if ($errors->has('date_show'))
            <span class="help-block">
                <strong>{{ $errors->first('date_show') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has('date_hide') ? ' has-error' : '' }}">
        {!! Form::label('date_hide', 'Mostrar hasta:') !!}
        {!! Form::text('date_hide', null, ['class' => 'form-control dates']) !!}
        @if ($errors->has('date_hide'))
            <span class="help-block">
                <strong>{{ $errors->first('date_hide') }}</strong>
            </span>
        @endif
    </div>
</div>