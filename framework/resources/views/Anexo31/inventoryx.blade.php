@extends('layouts.anexo31')

@section('htmlheader_title')
    Anexo 31 - Dashboard
@endsection

@section('header')
    @include('Headers.anexo31')
@endsection

@section('content')
    <div class="row">
		<input type="checkbox" id="toogle" onclick="changeValue(this)" /><label for="toogle"></label>
		<div class="table">
			<table >
	    	<thead>
	    		<th>ADUANA</th>
	    		<th>PATENTE</th>
	    		<th>PEDIMENTO</th>
	    		<th>FECHA</th>
	    		<th>FRACCION</th>
	    		<th>SALDO</th>
	    		<th>ACTIVO FIJO</th>
	    		<th>FOLIO</th>
	    	</thead>
	    	<tbody id="inv">
	    		@foreach($inventory as $inv)
	    		<tr>
	    			<td>{{ $inv->aduana }}</td>
	    			<td>{{ $inv->patente }}</td>
	    			<td>{{ $inv->pedimento }}</td>
	    			<td>{{ $inv->fecha }}</td>
	    			<td>{{ $inv->fraccion }}</td>
	    			<td>{{ $inv->saldo }}</td>
	    			<td>{{ $inv->afijo }}</td>
	    			<td>{{ $inv->folio }}</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    	<tbody id="rec" style="display: none">
	    		@foreach($rectifica as $rec)
	    		<tr>
	    			<td>{{ $rec->aduana }}</td>
	    			<td>{{ $rec->patente }}</td>
	    			<td>{{ $rec->pedimento }}</td>
	    			<td>{{ $rec->fecha }}</td>
	    			<td>{{ $rec->fraccion }}</td>
	    			<td>{{ $rec->saldo }}</td>
	    			<td>{{ $rec->afijo }}</td>
	    			<td>{{ $rec->folio }}</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
		</div>
	</div>
@endsection
<script type="text/javascript">
	function changeValue(cb) {
	  if(cb.checked == false)
	  {
	  	document.getElementById("inv").style.display = "table-row-group";
	  	document.getElementById("rec").style.display = "none";
	  }
	  else
	  {
	  	document.getElementById("inv").style.display = "none";
	  	document.getElementById("rec").style.display = "table-row-group";
	  }
	}
</script>
