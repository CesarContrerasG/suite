<?php 

namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Cove\Inventory;

class Invoice extends Model{

    protected $connection = 'default';
    protected $table = 'cove_comprobante';
    protected $guarded  =  ['inv_item'];
    protected $primaryKey='inv_item';
    public $timestamps = false;


    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public static function insertOrUpdate($request)
    {
        if($request->inv_item == "")
            $invoice = new Invoice;
        else
            $invoice = Invoice::find($request->inv_item);

        $subdivision = 0;
        $certificado = 0;
        $factor = 1;
        $cambio = 0;
        if($request->inv_subdivision == 'on')
            $subdivision = 1;
        if($request->inv_certorigen == 'on')
            $certificado = 1;
        $invoice->pk_item = $request->pk_item;
        $invoice->inv_cove = $request->inv_factura;
        $invoice->inv_factura = $request->inv_factura;
        $invoice->inv_fecha = $request->inv_fecha;
        $invoice->inv_moneda = $request->inv_moneda;
        if($request->inv_factorme != '')
            $factor = $request->inv_factorme;
        $invoice->inv_factorme = $request->inv_factorme;
         if($request->inv_tipocambio != '')
            $cambio = $request->inv_tipocambio;
        $invoice->inv_tipocambio = $cambio;
        
        $invoice->inv_subdivision = $subdivision;
        $invoice->inv_certorigen = $certificado;
        $invoice->inv_noexpconfiable = $request->inv_noexpconfiable;
        $invoice->emisor_tipoid = $request->emisor_tipoid;
        $invoice->emisor_clave = $request->emisor_clave;
        $invoice->emisor_identificador = $request->emisor_identificador;
        $invoice->emisor_paterno = $request->emisor_paterno;
        $invoice->emisor_materno = $request->emisor_materno;
        $invoice->emisor_nombre = $request->emisor_nombre;
        $invoice->emisor_calle = $request->emisor_calle;
        $invoice->emisor_noext = $request->emisor_noext;
        $invoice->emisor_noint = $request->emisor_noint;
        $invoice->emisor_col = $request->emisor_col;
        $invoice->emisor_localidad = $request->emisor_localidad;
        $invoice->emisor_mpo = $request->emisor_mpo;
        $invoice->emisor_edo = $request->emisor_edo;
        $invoice->emisor_pais = $request->emisor_pais;
        $invoice->emisor_cp = $request->emisor_cp;
        $invoice->dest_tipoid = $request->dest_tipoid;
        $invoice->dest_clave = $request->dest_clave;
        $invoice->dest_identificador = $request->dest_identificador;
        $invoice->dest_paterno = $request->dest_paterno;
        $invoice->dest_materno = $request->dest_materno;
        $invoice->dest_nombre = $request->dest_nombre;
        $invoice->dest_calle = $request->dest_calle;
        $invoice->dest_noext = $request->dest_noext;
        $invoice->dest_noint = $request->dest_noint;
        $invoice->dest_col = $request->dest_col;
        $invoice->dest_localidad = $request->dest_localidad;
        $invoice->dest_mpo = $request->dest_mpo;
        $invoice->dest_edo = $request->dest_edo;
        $invoice->dest_pais = $request->dest_pais;
        $invoice->dest_cp = $request->dest_cp;

        $invoice->save();
    }

    public function cove()
    {
        return $this->belongsTo('App\Cove\Cove', 'pk_item');
    }

    
    public static function all_parts()
    {
        $materials = Material::select('pk_mat as part', 'mat_descove as descove');
        $products = Product::select('pk_prod as part',  'prod_descove as descove');
        $assets = Asset::select('pk_af as part', 'af_descove as descove');
        $parts = $materials->union($products)->union($assets)->orderby('part')->pluck('part', 'part')->prepend('Selecciona...', 0);

        return $parts;
    }

    public static function import($xml, $request)
    {
        foreach ($xml->xpath('//cfdi:Comprobante') as $comprobante)
        {      
            $tipoCambio = (double) $comprobante['TipoCambio'];      
            $moneda = (string) $comprobante['Moneda'];
            $fecha = (string) $comprobante['Fecha'];
            $factura = (string) $comprobante['Folio'] .' '. (string) $comprobante['Serie'];                    
             
            foreach ($comprobante->xpath('//cfdi:Emisor') as $emisor)
            {
                $rfc_emisor = (string) $emisor['Rfc'];
                $nombre_emisor = (string) $emisor['Nombre'];
            }
            foreach ($comprobante->xpath('//cfdi:Receptor') as $destinatario)
            {
                $rfc_destinatario = (string) $destinatario['Rfc'];
                $tipo = 1;
                if($rfc_destinatario == 'XEXX010101000')
                {
                    $rfc_destinatario = '';
                    $rfc_destinatario = (string) $destinatario['NumRegIdTrib'];
                    $tipo = 0;
                }
                $nombre_destinatario = (string) $destinatario['Nombre'];
            }

             $data = [
                'pk_item'          => $request->pk_cove,
                'inv_cove'         => $factura,
                'inv_factura'      => $factura,
                'inv_fecha'        => $fecha,
                'inv_moneda'       => $moneda,
                'inv_tipocambio'   => $tipoCambio[0],
                'emisor_tipoid'    => 1,
                'emisor_identificador' => $rfc_emisor,
                'emisor_nombre'    => $nombre_emisor,
                'dest_tipoid'      => $tipo,
                'dest_identificador' => $rfc_destinatario,
                'dest_nombre' => $nombre_destinatario
            ];
            
            if($request->overwrite == 'on')
                Invoice::where('pk_item', $request->pk_cove)->where('inv_factura', $factura)->delete();
            Invoice::insert($data);
            
                                     
              
            foreach ($comprobante->xpath('//cfdi:Conceptos//cfdi:Concepto') as $inventario)
            {
                $numParte =  (string) $inventario['NoIdentificacion'];
                $cantidad = (double) $inventario['Cantidad'];
                $descripcion = (string) $inventario['Descripcion'];
                $valorUnitario = (double) $inventario['ValorUnitario'];
                $importe = (double)  $inventario['Importe'];
                $importe_usd = $importe * $tipoCambio;
                

                $data_inventario = [
                    'inv_cove'         => $factura,
                    'inv_factura'      => $factura,
                    'inv_item'         => $request->pk_cove,
                    'inv_numparte'     => $numParte,
                    'inv_descripcion'  => $descripcion,
                    'inv_descove'      => $descripcion,
                    'inv_cantidad'     => $cantidad,
                    'inv_valorunitario' => $valorUnitario,
                    'inv_moneda'       => $moneda,
                    'inv_valortotal'   => $importe,
                    'inv_valorusd'     => $importe_usd
                ];
                if($request->overwrite == 'on')
                    Inventory::where('inv_item', $request->pk_cove)->where('inv_factura', $factura)->where('inv_numparte', $numParte)->delete();
                Inventory::insert($data_inventario);

            }
        }

       
    }
}