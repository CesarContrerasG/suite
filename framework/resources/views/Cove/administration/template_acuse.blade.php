<!DOCTYPE html>
<html>
	<head>
	  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	    <title>Acuse Comprobante de Valor</title>
	    <link href="{{ asset('dist/css/template.css') }}" rel="stylesheet">        
  	</head>
	<body>
		<header>
			<div class="colors">
			    <img src="{{ asset('dist/img/cuadros.jpg') }}" width="120px" height="30px">
			</div>	
			<p>	  	
		  		ACUSE DE COMPROBANTE DE VALOR ELECTRÓNICO
		    </p>
		</header>
		<br>
		<div class="section smallme">
			<div class="col-1 text-right">
				<strong>RAZÓN SOCIAL: </strong><label> {{ $data_firma->name}}</label><br>
				<strong>R.F.C.: </strong><label> {{ $data_firma->rfc }}</label>
			</div>
			<br>
			<div class="col-1">
				<strong>Operación: </strong><label>	Registro de Información de Valor y de Comercialización</label>
			</div>
			<div class="col-1">
				<strong>Número de Acuse de Valor:</strong><label>{{ $data_cove->cove_edocument }}</label>
			<div class="col-1">
				<strong>Número de ADENDA: </strong>
				<label>
				@if($data_cove->cove_adenda != 0)
				{{ $data_cove->cove_numadenda}}
				@else
				N/A
				@endif				
				</label>
			</div>
			<div class="col-1">
				<strong>Factura/Relación: </strong><label>{{ $data_cove->cove_factura }}</label>
			</div>
			<div class="col-1">
				<strong>Fecha de Registro: </strong><label>{{ $data_cove->cove_fecha_edocument }}</label>
				<br><br><br>
			</div>
			<div class="col-1 text-right">				
				<label class="subtitle">Cadena Original</label><br>
				<div style='word-wrap: break-word;' class="smallme">{{ $data_cove->cove_cadenaoriginal }}</div>
			</div>
			<div class="col-1">
				<label class="subtitle">Sello Digital</label><br>
				<div style='word-wrap: break-word;' class="smallme">{{ $data_cove->cove_sellosolicita }}</div>
			</div>
		</div><!--.col-->
	</body>
</html>
