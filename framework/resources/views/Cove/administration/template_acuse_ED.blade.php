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
				<strong>RAZÓN SOCIAL: </strong><label> {{ $company->business_name }}</label>
				<strong>R.F.C.: </strong><label> {{ $company->rfc }}</label>
			</div>
			<br>
			<div class="col-2">
					<strong>Operación: </strong><label>	Registro de documentos digitalizados</label>
					<strong>Número de eDocument: </strong><label class='subject'>{{ $digital->imgEdocument }}</label>
					<strong>Tipo de Documento: </strong><label>{{ $digital->strImageName }}</label>
					<strong>Nombre del Documento: </strong><label>{{ $digital->imgNameFile }}</label>
					@if($digital->imgRfc != '')
					<strong>R.F.C. para consulta: </strong><label>{{ $digital->imgRfc}}</label>
					@endif
			</div>
	    <div class="col-1 text-right">
				  <label class="subtitle">Cadena Original</label>
					<div style='word-wrap: break-word;' class="smallme">{{ $digital->imgCadenaOriginal }}</div>
			</div>
			<br>
			<div class="col-1">
				<label class="subtitle">Sello Digital</label>
				<div style='word-wrap: break-word;' class="smallme">{{ $digital->imgSello }}</div>
			</div>
		</div><!--.col-->
	</body>
</html>
