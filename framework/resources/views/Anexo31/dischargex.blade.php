@extends('layouts.anexo31')

@section('htmlheader_title')
    Anexo 31 - Dashboard
@endsection

@section('header')
    @include('Headers.anexo31')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel with-padding row">
				<p class="text-xs">DESCARGO</p>
				{!! Form::open(['route' => ['anexo31.dischange.store'], 'method' => 'POST', 'files' => true, 'class' => 'form']) !!}
					Fecha de Corte
					<input type="text" name="fecha_ini" id="date_start" />
					{!! Form::submit('subir') !!}              
				{!! Form::close() !!}
			</div>
	    </div>
    </div>
@endsection
