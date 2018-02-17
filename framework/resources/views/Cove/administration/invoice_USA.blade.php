<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Invoice US</title>
        <link href="{{ asset('dist/css/template.css') }}" rel="stylesheet">
    </head>
    <body> 
        <header>
			<div class="colors">
			   <img src="{{ asset('dist/img/cuadros.jpg') }}" width="120px" height="30px">
			</div>	
			<p>	  	
		  		IMPORT INVOICE
		    </p>
		</header>
        <br>
		<div class="section smallme">  
            <div class="col-1 text-right">
			    <label>INVOICE: </label><label class="title">{{ $cove->cove_factura }}</label>
                <label>DATE: </label><label>{{ $cove->cove_fecha }}</label>
            </div>
            <br>
            @foreach($cove->invoices()->get() as $invoice)
                <div class="col-2">
                    <strong>SHIPPER:</strong>
                    <strong>{{ $invoice->emisor_nombre}}</strong>
                    <label>{{ $invoice->emisor_calle }}</label>
                    <label>{{ $invoice->emisor_col }}, No. Ext. {{ $invoice->emisor_noext }} No. Int. {{ $invoice->emisor_noint }}</label>
                    <label>{{ $invoice->emisor_mpo }}, {{ $invoice->emisor_edo }}, {{ $invoice->emisor_pais }}</label>
                    <label>I.R.S. {{ $invoice->emisor_identificador }}</label>
                </div>
                <br>
                <div class="col-2">
                    <strong>CONSIGNEE:</strong>
                    <strong>{{ $invoice->dest_nombre}}</strong>
                    <label>{{ $invoice->dest_calle }}</label>
                    <label>{{ $invoice->dest_col }}, No. Ext. {{ $invoice->dest_noext }} No. Int. {{ $invoice->dest_noint }}</label>
                    <label>{{ $invoice->dest_mpo }}, {{ $invoice->dest_edo }}, {{ $invoice->dest_pais }}</label>
                    <label>I.R.S. {{ $invoice->dest_identificador }}</label>
                </div>
                <br>
                <table class="table table-striped table-condensed ">
                    <thead>
                        <tr>
                            <th>PACKING</th>
                            <th colspan="3">PART NUMBER / DESCRIPTION</th>
                            <th>QUANTITY/NET WEIGHT/[HTS QUANTITY]</th>
                            <th>COUNTRY ORIGIN</th>
                            <th>HTS US </th>
                            <th>UNIT VALUE</th>
							<th>EXTENDED VALUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cove->inventory()->where('inv_factura', $invoice->inv_factura)->get() as $inventory)
                        <tr>
                            <td></td>
                            <td colspan="3">{{ $inventory->inv_descove }} N.P. {{ $inventory->inv_numparte }}</td>
                            <td>{{ $inventory->inv_cantidad }}</td>
							<td></td>
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

