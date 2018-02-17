@extends('suite.enterprise')

@section('header')
    @include('Platform.enterprise.header')
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}">Home</a></li>
    <li>Usuarios</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                @include('Platform.enterprise.panel-master')
            </div>

            <div class="col-md-8">
            	<div class="row">
					<div class="col-md-12">
						<div class="with-margin-vertical text-right">
							@if(auth()->user()->company_id == auth()->user()->master_id)
								<a href="{{ route('platform.users.create') }}" class="btn btn-sm btn-default btn-round btn-round-green btn-bg-transparent">agregar usuario</a>
								<a href="{{ route('platform.client.create') }}" class="btn btn-sm btn-default btn-round btn-round-green btn-bg-transparent">agregar cliente</a>
							@else
								<a href="{{ route('platform.users.create') }}" class="btn btn-sm btn-default btn-round btn-round-green btn-bg-transparent">agregar usuario</a>
							@endif
						</div>
					</div>

					@include('Platform.users.partials.grid')
            	</div>
            </div>

        </div>
    </div>

{!! Form::open(['route' => ['platform.users.destroy', ':ID_USER'], 'method' => 'DELETE', 'id' => 'form_delete']) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
	<script>
	$('.btn-delete').click(function(e){
		e.preventDefault();
		var user = $(this).data('user');
		var card = $(this).parent().parent().parent().parent().parent().parent().parent();
		var form = $('#form_delete');
		var url = form.attr('action').replace(':ID_USER', user);
		var data = form.serialize();

		card.fadeOut();

		$.post(url, data, function(result){
			console.log(result.message);
		}).fail(function(){
			alert("Lo sentimos, hubo un error interno del servidor.");
			location.reload();
		});
	});
	</script>
@endsection