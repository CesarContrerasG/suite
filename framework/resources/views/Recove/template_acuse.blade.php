<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('css/template.css') }}">
	<title>Acuse E-document</title>
</head>
	<body>
		<header>
			<div class="colors">
			    <img src="img/cuadros.jpg" width="120px" height="30px">
			</div>	
			<p>	  	
		  		<strong>ACUSE DE COMPROBANTE DE VALOR ELECTRÓNICO</strong>	      
		    </p>
		</header>
		<div class="section">  
			  <div class="col-1">
			    <p class="smallme">
			    	<strong>RAZÓN SOCIAL: </strong><label> {{ $data_firma->name}}</label><br>
					<strong>R.F.C.: </strong><label> {{ $data_firma->rfc }}</label>
				</p>
				<p class="col-2">
					<strong>Operación: </strong><label>	Registro de Información de Valor y de Comercialización</label><br>
					<strong>Número de Acuse de Valor:</strong><label class='subject'>{{ $data_cove->cove_edocument }}</label><br>
					<strong>Número de ADENDA: </strong>
					<label>
					@if($data_cove->cove_adenda != 0)
					{{ $data_cove->cove_numadenda}}
					@else
					N/A
					@endif
					</label><br>
					<strong>Factura/Relación: </strong><label>{{ $data_cove->cove_factura }}</label><br>
					<strong>Fecha de Registro: </strong><label>{{ $data_cove->cove_fecha_edocument }}</label><br>
			    </p>
			    <br><br>
			    <div class="col-1 text-right">
				    <h1>Cadena Original</h1>
					<div style='word-wrap: break-word;' class="smallme">{{ $data_cove->cove_cadenaoriginal }}</div><br><br>
					<h1>Sello Digital</h1>
					<div style='word-wrap: break-word;' class="smallme">{{ $data_cove->cove_sellosolicita }}</div><br>
				</div>
			  </div><!--.col-->
		</div>		
	</body>
</html>
