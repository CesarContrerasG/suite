<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ public_path().'/dist/css/template.css' }}">
	<title>Acuse E-document</title>
</head>
	<body>
		<header>
			<div class="colors">
		      <img src="img/cuadros.jpg">
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
					<strong>Operación: </strong><label>	Registro de documentos digitalizados</label><br>
					<strong>Número de eDocument: </strong><label class='subject'>{{ $document->imgEdocument }}</label><br>					
					<strong>Tipo de Documento: </strong><label>{{ $document->strImageName }}</label><br>
					<strong>Nombre del Documento: </strong><label>{{ $document->imgNameFile }}</label><br>
					@if($document->imgRfc != '')
					<strong>R.F.C. para consulta: </strong><label>{{ $document->imgRfc}}</label><br>
					@endif
			    </p>
			    <br><br>
			    <div class="col-1 text-right">
				    <h1>Cadena Original</h1>
					<div style='word-wrap: break-word;' class="smallme">{{ $document->imgCadenaOriginal }}</div><br><br>
					<h1>Sello Digital</h1>
					<div style='word-wrap: break-word;' class="smallme">{{ $document->imgSello }}</div><br>
				</div>
			  </div><!--.col-->
		</div>		
	</body>
</html>
