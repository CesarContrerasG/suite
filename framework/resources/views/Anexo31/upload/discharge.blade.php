{!! Form::open(['route' => ['anexo31.discharge.store'], 'method' => 'POST', 'files' => true]) !!}
	<div class="col-md-8">
		<div class="form_group">
			<label for="folio">Folio</label>
			{!! Form::text('folio', null, ['id' => 'folio', 'class' => 'form_control']) !!}<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form_group">
			<label for="year">Año</label>
			{!! Form::selectYear('year', 2015, date('Y'), null, ['onclick' => 'changeDischarge()', 'class' => 'form_control']) !!}<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form_group">
			<label for="period">Año</label>
			{!! Form::select('period', \App\Anexo31\Period::pluck('descripcion','id'), null, ['id' => 'period', 'onclick' => 'changeDischarge()', 'class' => 'form_control']) !!}<br>
		</div>
	</div>
	<div class="col-md-8">
		<div class="form_group">
			{!! Form::file('file') !!}
		</div>
	</div>
	<div class="col-md-8">
		<div class="form_group">
			{!! Form::submit('subir', ['class' => 'btn btn-default success btn-xs']) !!}
		</div>
	</div>
{!! Form::close() !!}
<div class="col-md-6">
	<table class="table table-striped table-condensed" id="destinations">
        <thead>
            <tr>
                <th colspan="2">DESTINO</th>
                <th>CARGADO</th>
            </tr>
        </thead>
        <tbody> 
		</tbody>
	</table>
</div>

<script>
	function changeDischarge(){
		$("#destinations tbody tr").remove(); 
		var year = document.getElementsByName('year')[0].value;
		var period = document.getElementsByName('period')[0].value;
		$.post('discharge/check',	{"_token": "{{ csrf_token() }}", "year": year, "period": period}, function(resul) {
			resul.destination.forEach(function (item) {	
				row = '<tr id="td-"'+item.id+'><td colspan="2">' + item.des_clave + ' - ' + item.des_descrip +'</td>';			
				resul.discharge.forEach(function (desc) {
					if(desc.destino == item.id)	
						row += '<td>OK</td>';	
					else
						row += '<td></td>';					
				});
				row += '</tr>';
				$('#destinations > tbody:last').append(row);
			});
		});
	}
</script>