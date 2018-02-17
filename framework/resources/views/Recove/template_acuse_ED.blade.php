<!DOCTYPE html>
<html>
<head>
	
	<title>Acuse E-document</title>
	<style type="text/css">
		body{
	margin: 0;
	padding: 0;
}
.col, .logoholder, .me, .info{
  vertical-align: top;
  display: inline-block;
  font-size: 1rem;
  padding: 0 1rem;
  min-height: 1px;
}
.colors {
  float: left;
}
.color {
  cursor: pointer;
  display: block;
  float: left;
  margin-right: .25rem;
  width: 1rem;
  height: 1rem;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  -webkit-transition-property: opacity;
  transition-property: opacity;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.colors .color:last-child {
  margin-right: 0;
}
.color-1 {
  background-color: #D9453F;
}
.color-2 {
  background-color: #4790B0;
}
.color-3 {
  background-color: #3C994B;
}
.color-4 {
  background-color: #F2D060;
}
.color-5 {
  background-color: #FF774F;
}
.col-2 {
  width: 60%;
}
.col-1 {
  width: 100%;
}
.col-3{
  width: 33.3%;
}
.text-center {
  text-align: center;
}
.text-right {
  text-align: right;
}
header {
  margin: 1rem 0 0;
  padding: 0;
  border-bottom: 3pt solid #F14C4C;
}
header p {
  font-size: 1.2rem;
  text-align: right;
  padding: 0;
}
h1{
  margin: 0;
  padding: 0;
  font-size: .9rem;
  font-weight: normal;  
  text-transform: uppercase;
  color: #F14C4C;
}
/**
 * SECTION
 */
.section {
  margin: 3rem 0 0;
}
.smallme {
  display: inline-block;
  margin: 0 0 2rem 0;
  font-size: .9rem;
}

footer{
	position: absolute;
	bottom: 0;
	left: 0;
	margin: 0;
	right: 0;
	height:50px;
	background: #db4c3f;
}

	</style>
</head>
	<body>
		<header>
			<div class="colors">
		      <img src="{{ base_path().'/cuadros.jpg' }}" width="120px" height="30px">
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
