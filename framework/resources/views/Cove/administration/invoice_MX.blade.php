<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Factura MX</title>
        <link href="{{ asset('dist/css/template.css') }}" rel="stylesheet">
    </head>
    <body> 
        <header>
			<div class="colors">
			   <img src="{{ asset('dist/img/cuadros.jpg') }}" width="120px" height="30px">
			</div>	
			<p>	  	
		  		FACTURA DE IMPORTACIÓN    
		    </p>
		</header>
        <br>
		<div class="section smallme">  
            <div class="col-1 text-right">
			    <label>No Factura: </label><label class="title">{{ $cove->cove_factura }}</label><br>
                <label>Fecha: </label><label>{{ $cove->cove_fecha }}</label><br><br>
            </div>
            @foreach($cove->invoices()->get() as $invoice)
                <div class="col-1">
                    <strong>{{ $invoice->emisor_nombre}}</strong>
                </div>
                <div class="col-3">
                    <label>{{ $invoice->emisor_calle }}</label>
                    <label>{{ $invoice->emisor_col }}, No. Ext. {{ $invoice->emisor_noext }} No. Int. {{ $invoice->emisor_noint }}</label>
                    <label>{{ $invoice->emisor_mpo }}, {{ $invoice->emisor_edo }}, {{ $invoice->emisor_pais }}</label>
                    <label>R.F.C. {{ $invoice->emisor_identificador }}</label>
                </div>
                <br>
                <div class="col-1">
                    <strong>{{ $invoice->dest_nombre}}</strong>
                </div>
                <div class="col-3">
                    <label>{{ $invoice->dest_calle }}</label>
                    <label>{{ $invoice->dest_col }}, No. Ext. {{ $invoice->dest_noext }} No. Int. {{ $invoice->dest_noint }}</label>
                    <label>{{ $invoice->dest_mpo }}, {{ $invoice->dest_edo }}, {{ $invoice->dest_pais }}</label>
                    <label>R.F.C. {{ $invoice->dest_identificador }}</label>
                </div>
                <br>
                <table class="table table-striped table-condensed ">
                    <thead>
                        <tr>
                            <th>BULTOS</th>
                            <th>PESO</th>
                            <th>CANTIDAD U.M.</th>
                            <th colspan="3">DESCRIPCION</th>
                            <th>PAIS DE ORIGEN</th>
                            <th>VALOR UNITARIO (US)</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cove->inventory()->where('inv_factura', $invoice->inv_factura)->get() as $inventory)
                        <tr>
                            <td>{{ $inventory->inv_bultos }}</td>
                            <td></td>
                            <td>{{ $inventory->inv_cantidad }}</td>
                            <td colspan="3">{{ $inventory->inv_descove }} N.P. {{ $inventory->inv_numparte }}</td>
                            <td></td>
                            <td>{{ $inventory->inv_valorunitario }}</td>
                            <td>{{ $inventory->inv_valortotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-1 text-right">
                    <strong>US {{ $cove->inventory()->where('inv_factura', $invoice->inv_factura)->groupby('inv_factura')->sum('inv_valortotal') }}</strong>
                </div>
            @endforeach
        </div>
    </body>
</html>

