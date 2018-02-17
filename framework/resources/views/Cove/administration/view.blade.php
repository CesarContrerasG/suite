<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Factura/COVE</title>
        <link href="{{ asset('dist/css/template.css') }}" rel="stylesheet">        
    </head>
    <body> 
        <header>
			<div class="colors">
			   <img src="{{ asset('dist/img/cuadros.jpg') }}" width="120px" height="30px">
			</div>	
			<p>	  	
		  		COMPROBANTE DE VALOR ELECTRÓNICO     
		    </p>
		</header>
        <br>
		<div class="section smallme"> 
            <div class="col-1 text-right">
			    <label>Factura/Proforma No. </label><label class="title">{{ $cove->cove_factura }}</label><br>
                <label>Fecha: {{ $cove->cove_fecha }}</label>
            </div>
            <div class="col-3">
			    <label>Tipo de Operacion: {{$cove->pk_tipo == 1 ? 'IMPORTACIÓN' : 'EXPORTACIÓN'}}</label>
                <label>No. Edocument: </label><strong>{{ $cove->cove_edocument }}</strong>
                <label>Fecha: {{ $cove->cove_fecha_edocument }}</label>
            </div>
            <br>
            @foreach($cove->invoices()->get() as $invoice)
                <div class="col-1">
                    <div class="col-2">
                        <strong>Emisor</strong>
                        <label>{{ $invoice->emisor_nombre}}</label><br>
                        <label>{{ $invoice->emisor_calle }}</label>
                        <label>{{ $invoice->emisor_col }}, No. Ext. {{ $invoice->emisor_noext }} No. Int. {{ $invoice->emisor_noint }}</label>
                        <label>{{ $invoice->emisor_mpo }}, {{ $invoice->emisor_edo }}, {{ $invoice->emisor_pais }}</label><br>
                        <label>R.F.C. {{ $invoice->emisor_identificador }}</label>
                    </div>
                    <br>
                    <div class="col-2">
                        <strong>Destinatario</strong>
                        <label>{{ $invoice->dest_nombre}}</label><br>
                        <label>{{ $invoice->dest_calle }}</label>
                        <label>{{ $invoice->dest_col }}, No. Ext. {{ $invoice->dest_noext }} No. Int. {{ $invoice->dest_noint }}</label>
                        <label>{{ $invoice->dest_mpo }}, {{ $invoice->dest_edo }}, {{ $invoice->dest_pais }}</label><br>
                        <label>R.F.C. {{ $invoice->dest_identificador }}</label>
                    </div>
                </div>
                <br><br>
                 <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Concepto</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Precio Unitario</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($cove->inventory()->where('inv_factura', $invoice->inv_factura)->get() as $inventory)
                        <tr>
                            <td>{{ $inventory->pk_item }}</td>
                            <td>{{ $inventory->inv_descove }} N.P. {{ $inventory->inv_numparte }}</td>
                            <td>{{ $inventory->inv_cantidad }}</td>
                            <td>{{ $inventory->inv_oma }}</td>
                            <td>{{ $inventory->inv_valorunitario }}</td>
                            <td>{{ $inventory->inv_valortotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-1 text-right">
                    <strong>TOTAL $ {{ $cove->inventory()->where('inv_factura', $invoice->inv_factura)->groupby('inv_factura')->sum('inv_valortotal') }}</strong>
                </div>                    
            @endforeach
        </div>
    </body>
</html>
