<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Qore\AduanaRequest;
use App\Http\Requests\Qore\AduanaImportRequest;
use App\Http\Requests\Qore\CPedimentoRequest;
use App\Http\Requests\Qore\CPedimentoImportRequest;
use App\Http\Requests\Qore\TransportRequest;
use App\Http\Requests\Qore\TransportImportRequest;
use App\Http\Requests\Qore\CountryRequest;
use App\Http\Requests\Qore\CountryImportRequest;
use App\Http\Requests\Qore\CurrencyRequest;
use App\Http\Requests\Qore\CurrencyImportRequest;
use App\Http\Requests\Qore\EnclosureRequest;
use App\Http\Requests\Qore\EnclosureImportRequest;
use App\Http\Requests\Qore\UnitRequest;
use App\Http\Requests\Qore\UnitImportRequest;
use App\Http\Requests\Qore\IdentifierRequest;
use App\Http\Requests\Qore\IdentifierImportRequest;
use App\Http\Requests\Qore\RegularizationRequest;
use App\Http\Requests\Qore\RegularizationImportRequest;
use App\Http\Requests\Qore\ContainerRequest;
use App\Http\Requests\Qore\ContainerImportRequest;
use App\Http\Requests\Qore\ValuationRequest;
use App\Http\Requests\Qore\ValuationImportRequest;
use App\Http\Requests\Qore\ContributionRequest;
use App\Http\Requests\Qore\ContributionImportRequest;
use App\Http\Requests\Qore\PaymentRequest;
use App\Http\Requests\Qore\PaymentImportRequest;
use App\Http\Requests\Qore\BillingRequest;
use App\Http\Requests\Qore\BillingImportRequest;
use App\Http\Requests\Qore\DestinationRequest;
use App\Http\Requests\Qore\DestinationImportRequest;
use App\Http\Requests\Qore\RegimenRequest;
use App\Http\Requests\Qore\RegimenImportRequest;
use App\Http\Requests\Qore\ConsolidRequest;
use App\Http\Requests\Qore\ConsolidImportRequest;
use App\Http\Requests\Qore\RateRequest;
use App\Http\Requests\Qore\RateImportRequest;
use App\Http\Requests\Qore\SubstanceRequest;
use App\Http\Requests\Qore\SubstanceImportRequest;
use App\Http\Requests\Qore\StrategicRequest;
use App\Http\Requests\Qore\StrategicImportRequest;
use App\Http\Requests\Qore\OMAUnitRequest;
use App\Http\Requests\Qore\OMAUnitImportRequest;
use App\Http\Requests\Qore\OMACurrencyRequest;
use App\Http\Requests\Qore\OMACurrencyImportRequest;
use App\Http\Requests\Qore\FactorRequest;
use App\Http\Requests\Qore\FactorImportRequest;
use App\Http\Requests\Qore\ChangeRequest;
use App\Http\Requests\Qore\ChangeImportRequest;
use App\Http\Requests\Qore\INPCRequest;
use App\Http\Requests\Qore\INPCImportRequest;
use App\Http\Requests\Qore\FractionRequest;
use App\Http\Requests\Qore\FractionImportRequest;

use App\Qore\Aduana;
use App\Qore\CPedimento;
use App\Qore\Transport;
use App\Qore\Country;
use App\Qore\Currency;
use App\Qore\Enclosure;
use App\Qore\Unit;
use App\Qore\Identifier;
use App\Qore\Regularization;
use App\Qore\Container;
use App\Qore\Valuation;
use App\Qore\Contribution;
use App\Qore\Payment;
use App\Qore\Billing;
use App\Qore\Destination;
use App\Qore\Regimen;
use App\Qore\Consolid;
use App\Qore\Rate;
use App\Qore\Substance;
use App\Qore\Strategic;
use App\Qore\OMAUnit;
use App\Qore\OMACurrency;
use App\Qore\Factor;
use App\Qore\Change;
use App\Qore\INPC;
use App\Qore\Fraction;

class CatalogController extends Controller
{
    public function index()
    {
        return view('Qore.catalogs.index');
    }

    /*
     * Catalogo Aduana Sección
     */
    public function aduanas()
    {
        $aduanas = Aduana::paginate(15);
        return view('Qore.catalogs.aduanas.index', compact('aduanas'));
    }

    public function aduanaStore(AduanaRequest $request)
    {
        Aduana::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.aduana.index');
    }

    public function aduanaEdit(Aduana $aduana)
    {
        return view('Qore.catalogs.aduanas.edit', compact('aduana'));
    }

    public function aduanaUpdate(Aduana $aduana, AduanaRequest $request)
    {
        $aduana->fill($request->all());
        $aduana->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.aduana.index');
    }

    public function aduanaDestroy(Aduana $aduana, Request $request)
    {
        $aduana->delete();
        $aduana->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.aduana.index');
    }

    public function aduanaImport(AduanaImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['id' => $value->id, 'adu_numero' => $value->adu_numero, 'adu_seccion' => $value->adu_seccion, 'adu_denomina' => $value->adu_denomina];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_aduanas')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.aduana.index');
                }
            }
        }
        return back();
    }

    public function aduanaExport()
    {
        Excel::create('aduana-seccion', function($excel){
            $excel->sheet('Aduana-Seccion', function($sheet){
                $aduanas = Aduana::select('id', 'adu_numero', 'adu_seccion', 'adu_denomina')->get();
                $sheet->fromArray($aduanas);
            });
        })->download('csv');
    }

    public function aduanaDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/aduana-seccion.csv');
    }

    /*
     * Catalogo Clave de Pedimentos
     */

    public function cpediments()
    {
        $claves = CPedimento::paginate(15);
        return view('Qore.catalogs.claves_pedimento.index', compact('claves'));
    }

    public function cpedimentStore(CPedimentoRequest $request)
    {
        CPedimento::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.cpediments.index');
    }

    public function cpedimentEdit(CPedimento $cpedimento)
    {
        return view('Qore.catalogs.claves_pedimento.edit', compact('cpedimento'));
    }

    public function cpedimentUpdate(CPedimento $cpedimento, CPedimentoRequest $request)
    {
        $cpedimento->fill($request->all());
        $cpedimento->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.cpediments.index');
    }

    public function cpedimentDestroy(CPedimento $cpedimento, Request $request)
    {
        $cpedimento->delete();
        $cpedimento->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.cpediments.index');
    }

    public function cpedimentExport()
    {
        Excel::create('claves-pedimento', function($excel){
            $excel->sheet('Claves de Pedimento', function($sheet){
                $claves = CPedimento::select('cpe_clave', 'cpe_descrip', 'cpe_usos', 'cpe_regi', 'cpe_rege', 'cpe_import', 'cpe_export', 'cpe_peps', 'cpe_px', 'cpe_dirigido', 'cpe_ps')->get();
                $sheet->fromArray($claves);
            });
        })->download('csv');
    }

    public function cpedimentDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/claves-pedimento.csv');
    }

    public function cpedimentImport(CPedimentoImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['cpe_clave' => $value->cpe_clave, 'cpe_descrip' => $value->cpe_descrip, 'cpe_usos' => $value->cpe_usos, 'cpe_regi' => $value->cpe_regi, 'cpe_rege' => $value->cpe_rege, 'cpe_import' => $value->cpe_import, 'cpe_export' => $value->cpe_export, 'cpe_peps' => $value->cpe_peps, 'cpe_px' => $value->cpe_px, 'cpe_dirigido' => $value->cpe_dirigido, 'cpe_ps' => $value->cpe_ps];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_cpedimen')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.cpediments.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Medios de Transporte
     */

    public function transports()
    {
        $transports = Transport::paginate(15);
        return view('Qore.catalogs.transports.index', compact('transports'));
    }

    public function transportStore(TransportRequest $request)
    {
        Transport::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.transports.index');
    }

    public function transportEdit(Transport $transport)
    {
        return view('Qore.catalogs.transports.edit', compact('transport'));
    }

    public function transportUpdate(Transport $transport, TransportRequest $request)
    {
        $transport->fill($request->all());
        $transport->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.transports.index');
    }

    public function transportDestroy(Transport $transport, Request $request)
    {
        $transport->delete();
        $transport->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.transports.index');
    }

    public function transportsExport()
    {
        Excel::create('medios-transporte', function($excel){
            $excel->sheet('Medios de Transporte', function($sheet){
                $transports = Transport::select('tra_clave', 'tra_medio')->get();
                $sheet->fromArray($transports);
            });
        })->download('csv');
    }

    public function transportsDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/medios-transporte.csv');
    }

    public function transportImport(TransportImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['tra_clave' => $value->tra_clave, 'tra_medio' => $value->tra_medio];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_transp')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.transports.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Clave de Paises
     */

    public function countries()
    {
        $countries = Country::paginate(15);
        return view('Qore.catalogs.countries.index', compact('countries'));
    }

    public function countryStore(CountryRequest $request)
    {
        Country::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.countries.index');
    }

    public function countryEdit(Country $country)
    {
        return view('Qore.catalogs.countries.edit', compact('country'));
    }

    public function countryUpdate(Country $country, CountryRequest $request)
    {
        $country->fill($request->all());
        $country->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.countries.index');
    }

    public function countryDestroy(Country $country, Request $request)
    {
        $country->delete();
        $country->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.countries.index');
    }

    public function countriesExport()
    {
        Excel::create('claves-paises', function($excel){
            $excel->sheet('Claves de Paises', function($sheet){
                $transports = Country::select('pai_clavefiii', 'pai_clavem3', 'pai_nombre')->get();
                $sheet->fromArray($transports);
            });
        })->download('csv');
    }

    public function countriesDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/claves-paises.csv');
    }

    public function countriesImport(CountryImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['pai_clavefiii' => $value->pai_clavefiii, 'pai_clavem3' => $value->pai_clavem3, 'pai_nombre' => $value->pai_nombre];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_paises')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.countries.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Clave de Monedas
     */

    public function currencies()
    {
        $currencies = Currency::paginate(15);
        $countries = Country::pluck('pai_nombre', 'id');
        return view('Qore.catalogs.currencies.index', compact('currencies', 'countries'));
    }

    public function currencyStore(CurrencyRequest $request)
    {
        Currency::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.currencies.index');
    }

    public function currencyEdit(Currency $currency)
    {
        $countries = Country::pluck('pai_nombre', 'id');
        return view('Qore.catalogs.currencies.edit', compact('currency', 'countries'));
    }

    public function currencyUpdate(Currency $currency, CurrencyRequest $request)
    {
        $currency->fill($request->all());
        $currency->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.currencies.index');
    }

    public function currencyDestroy(Currency $currency, Request $request)
    {
        $currency->delete();
        $currency->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.currencies.index');
    }

    public function currenciesExport()
    {
        Excel::create('claves-monedas', function($excel){
            $excel->sheet('Claves de Monedas', function($sheet){
                $currencies = Currency::select('mon_clave', 'mon_nombre', 'mon_pais')->get();
                $sheet->fromArray($currencies);
            });
        })->download('csv');
    }

    public function currenciesDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/claves-monedas.csv');
    }

    public function currenciesImport(CurrencyImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['mon_clave' => $value->mon_clave, 'mon_nombre' => $value->mon_nombre, 'mon_pais' => $value->mon_pais];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_monedas')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.currencies.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Recintos Fiscalizados
     */

    public function enclosures()
    {
        $enclosures = Enclosure::paginate(15);
        $aduanas = Aduana::pluck('adu_denomina', 'id');
        return view('Qore.catalogs.enclosures.index', compact('enclosures', 'aduanas'));
    }

    public function enclosureStore(EnclosureRequest $request)
    {
        Enclosure::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.enclosures.index');
    }

    public function enclosureEdit(Enclosure $enclosure)
    {
        $aduanas = Aduana::pluck('adu_denomina', 'id');
        return view('Qore.catalogs.enclosures.edit', compact('enclosure', 'aduanas'));
    }

    public function enclosureUpdate(Enclosure $enclosure, EnclosureRequest $request)
    {
        $enclosure->fill($request->all());
        $enclosure->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.enclosures.index');
    }

    public function enclosureDestroy(Enclosure $enclosure, Request $request)
    {
        $enclosure->delete();
        $enclosure->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.enclosures.index');
    }

    public function enclosuresExport()
    {
        Excel::create('recintos-fiscalizados', function($excel){
            $excel->sheet('Recintos Fiscalizados', function($sheet){
                $enclosures = Enclosure::select('rec_clave', 'rec_nombre', 'rec_aduana')->get();
                $sheet->fromArray($enclosures);
            });
        })->download('csv');
    }

    public function enclosuresDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/recintos-fiscalizados.csv');
    }

    public function enclosuresImport(EnclosureImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['rec_clave' => $value->rec_clave, 'rec_nombre' => $value->rec_nombre, 'rec_aduana' => $value->rec_aduana];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_recintos')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.enclosures.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Unidades de Medida
     */

    public function units()
    {
        $units = Unit::paginate(15);
        return view('Qore.catalogs.units.index', compact('units'));
    }

    public function unitStore(UnitRequest $request)
    {
        Unit::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.units.index');
    }

    public function unitEdit(Unit $unit)
    {
        return view('Qore.catalogs.units.edit', compact('unit'));
    }

    public function unitUpdate(Unit $unit, UnitRequest $request)
    {
        $unit->fill($request->all());
        $unit->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.units.index');
    }

    public function unitDestroy(Unit $unit, Request $request)
    {
        $unit->delete();
        $unit->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.units.index');
    }

    public function unitsExport()
    {
        Excel::create('unidades-medida', function($excel){
            $excel->sheet('Unidades de Medida', function($sheet){
                $units = Unit::select('ume_clave', 'ume_nombre')->get();
                $sheet->fromArray($units);
            });
        })->download('csv');
    }

    public function unitsDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/unidades-medida.csv');
    }

    public function unitsImport(UnitImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['ume_clave' => $value->ume_clave, 'ume_nombre' => $value->ume_nombre];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_umedida')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.units.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Unidades de Medida
     */

    public function identifiers()
    {
        $identifiers = Identifier::paginate(15);
        return view('Qore.catalogs.identifiers.index', compact('identifiers'));
    }

    public function identifierStore(IdentifierRequest $request)
    {
        Identifier::create($request->all());
        Session::flash('message', 'Registro exitoso !!');
        return redirect()->route('qore.catalogs.identifiers.index');
    }

    public function identifierEdit(Identifier $identifier)
    {
        return view('Qore.catalogs.identifiers.edit', compact('identifier'));
    }

    public function identifierUpdate(Identifier $identifier, IdentifierRequest $request)
    {
        $identifier->fill($request->all());
        $identifier->save();
        Session::flash('message', 'Edición exitosa');
        return redirect()->route('qore.catalogs.identifiers.index');
    }

    public function identifierDestroy(Identifier $identifier, Request $request)
    {
        $identifier->delete();
        $identifier->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.identifiers.index');
    }

    public function identifiersExport()
    {
        Excel::create('identificadores', function($excel){
            $excel->sheet('Identificadores', function($sheet){
                $identifiers = Identifier::select('ide_clave', 'ide_descrip', 'ide_nivel', 'ide_comp')->get();
                $sheet->fromArray($identifiers);
            });
        })->download('csv');
    }

    public function identifiersDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/identificadores.csv');
    }

    public function identifiersImport(IdentifierImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['ide_clave' => $value->ide_clave, 'ide_descrip' => $value->ide_descrip, 'ide_nivel' => $value->ide_nivel, 'ide_comp' => $value->ide_comp];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_ident')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.identifiers.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Regulaciones y Restricciones no Arancelaria
     */

    public function regularizations()
    {
        $regularizations = Regularization::paginate(15);
        return view('Qore.catalogs.regularizations.index', compact('regularizations'));
    }

    public function regularizationStore(RegularizationRequest $request)
    {
        Regularization::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.regularizations.index');
    }

    public function regularizationEdit(Regularization $regularization)
    {
        return view('Qore.catalogs.regularizations.edit', compact('regularization'));
    }

    public function regularizationUpdate(Regularization $regularization, RegularizationRequest $request)
    {
        $regularization->fill($request->all());
        $regularization->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.regularizations.index');
    }

    public function regularizationDestroy(Regularization $regularization, Request $request)
    {
        $regularization->delete();
        $regularization->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.regularizations.index');
    }

    public function regularizationsExport()
    {
        Excel::create('regularizaciones', function($excel){
            $excel->sheet('Regularizaciones', function($sheet){
                $regularizations = Regularization::select('reg_clave', 'reg_descrip', 'reg_instituc')->get();
                $sheet->fromArray($regularizations);
            });
        })->download('csv');
    }

    public function regularizationsDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/regularizaciones.csv');
    }

    public function regularizationsImport(RegularizationImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['reg_clave' => $value->reg_clave, 'reg_descrip' => $value->reg_descrip, 'reg_instituc' => $value->reg_instituc];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_regular')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.regularizations.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Tipo de contenedores y vehículos de autotransporte
     */

    public function containers()
    {
        $containers = Container::paginate(15);
        return view('Qore.catalogs.containers.index', compact('containers'));
    }

    public function containerStore(ContainerRequest $request)
    {
        Container::create($request->all());
        Session::flash('mesagge', 'Registro exitoso!!');
        return redirect()->route('qore.catalogs.containers.index');
    }

    public function containerEdit(Container $container)
    {
        return view('Qore.catalogs.containers.edit', compact('container'));
    }

    public function containerUpdate(Container $container, ContainerRequest $request)
    {
        $container->fill($request->all());
        $container->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.catalogs.containers.index');
    }

    public function containerDestroy(Container $container, Request $request)
    {
        $container->delete();
        $container->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        Session::flash('message', 'Borrado exitoso!!');
        return redirect()->route('qore.catalogs.containers.index');
    }

    public function containersExport()
    {
        Excel::create('contenedores', function($excel){
            $excel->sheet('Contenedores', function($sheet){
                $containers = Container::select('con_clave', 'con_descrip')->get();
                $sheet->fromArray($containers);
            });
        })->download('csv');
    }

    public function containersDownload()
    {
        return response()->download('apps/qore/administration/catalogs/oficials/contenedores.csv');
    }

    public function containersImport(ContainerImportRequest $request)
    {
        if($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($render){
            })->get();
            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
					$insert[] = ['con_clave' => $value->con_clave, 'con_descrip' => $value->con_descrip];
				}
                if(!empty($insert))
                {
                    \DB::table('mdb_conten')->insert($insert);
                    Session::flash('message', 'Importación de datos exitosa!!');
                    return redirect()->route('qore.catalogs.containers.index');
                }
            }
        }
        return back();
    }

    /*
     * Catalogo Claves de Metodos de Valoracion
     */

     public function valuations()
     {
         $valuations = Valuation::paginate(15);
         return view('Qore.catalogs.valuations.index', compact('valuations'));
     }

     public function valuationStore(ValuationRequest $request)
     {
         Valuation::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.valuations.index');
     }

     public function valuationEdit(Valuation $valuation)
     {
         return view('Qore.catalogs.valuations.edit', compact('valuation'));
     }

     public function valuationUpdate(Valuation $valuation, ValuationRequest $request)
     {
         $valuation->fill($request->all());
         $valuation->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.valuations.index');
     }

     public function valuationDestroy(Valuation $valuation, Request $request)
     {
         $valuation->delete();
         $valuation->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.valuations.index');
     }

     public function valuationsExport()
     {
         Excel::create('metodos-valoracion', function($excel){
             $excel->sheet('Metodos de Valoracion', function($sheet){
                 $valuations = Valuation::select('val_clave', 'val_descrip')->get();
                 $sheet->fromArray($valuations);
             });
         })->download('csv');
     }

     public function valuationsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/metodos-valoracion.csv');
     }

     public function valuationsImport(ValuationImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
 					$insert[] = ['val_clave' => $value->val_clave, 'val_descrip' => $value->val_descrip];
 				}
                 if(!empty($insert))
                 {
                     \DB::table('mdb_valora')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.valuations.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Contribuciones, Cuotas Compensatorias, Gravámenes y Derechos
      */

     public function contributions()
     {
         $contributions = Contribution::paginate(15);
         return view('Qore.catalogs.contributions.index', compact('contributions'));
     }

     public function contributionStore(ContributionRequest $request)
     {
         Contribution::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.contributions.index');
     }

     public function contributionEdit(Contribution $contribution)
     {
         return view('Qore.catalogs.contributions.edit', compact('contribution'));
     }

     public function contributionUpdate(Contribution $contribution, ContributionRequest $request)
     {
         $contribution->fill($request->all());
         $contribution->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.contributions.index');
     }

     public function contributionDestroy(Contribution $contribution, Request $request)
     {
         $contribution->delete();
         $contribution->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.contributions.index');
     }

     public function contributionsExport()
     {
         Excel::create('contribuciones-cuotas', function($excel){
             $excel->sheet('Contribuciones', function($sheet){
                 $contributions = Contribution::select('con_clave', 'con_descrip', 'con_abrev', 'con_nivel')->get();
                 $sheet->fromArray($contributions);
             });
         })->download('csv');
     }

     public function contributionsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/contribuciones-cuotas.csv');
     }

     public function contributionsImport(ContributionImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
 					$insert[] = ['con_clave' => $value->con_clave, 'con_descrip' => $value->con_descrip, 'con_abrev' => $value->con_abrev, 'con_nivel' => $value->con_nivel];
 				}
                 if(!empty($insert))
                 {
                     \DB::table('mdb_contrib')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.contributions.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Contribuciones, Cuotas Compensatorias, Gravámenes y Derechos
      */

     public function payments()
     {
         $payments = Payment::paginate(15);
         return view('Qore.catalogs.payments.index', compact('payments'));
     }

     public function paymentStore(PaymentRequest $request)
     {
         Payment::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.payments.index');
     }

     public function paymentEdit(Payment $payment)
     {
         return view('Qore.catalogs.payments.edit', compact('payment'));
     }

     public function paymentUpdate(Payment $payment, PaymentRequest $request)
     {
         $payment->fill($request->all());
         $payment->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.payments.index');
     }

     public function paymentDestroy(Payment $payment, Request $request)
     {
         $payment->delete();
         $payment->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.payments.index');
     }

     public function paymentsExport()
     {
         Excel::create('formas-pago', function($excel){
             $excel->sheet('Formas de Pago', function($sheet){
                 $payments = Payment::select('fpa_clave', 'fpa_descrip')->get();
                 $sheet->fromArray($payments);
             });
         })->download('csv');
     }

     public function paymentsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/formas-pago.csv');
     }

     public function paymentsImport(PaymentImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
 					$insert[] = ['fpa_clave' => $value->fpa_clave, 'fpa_descrip' => $value->fpa_descrip];
 				}
                 if(!empty($insert))
                 {
                     \DB::table('mdb_fpago')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.payments.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Terminos de Facturación
      */

     public function billings()
     {
         $billings = Billing::paginate(15);
         return view('Qore.catalogs.billings.index', compact('billings'));
     }

     public function billingStore(BillingRequest $request)
     {
         Billing::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.billings.index');
     }

     public function billingEdit(Billing $billing)
     {
         return view('Qore.catalogs.billings.edit', compact('billing'));
     }

     public function billingUpdate(Billing $billing, BillingRequest $request)
     {
         $billing->fill($request->all());
         $billing->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.billings.index');
     }

     public function billingDestroy(Billing $billing, Request $request)
     {
         $billing->delete();
         $billing->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.billings.index');
     }

     public function billingsExport()
     {
         Excel::create('terminos-facturacion', function($excel){
             $excel->sheet('Terminos de Facturacion', function($sheet){
                 $billings = Billing::select('tfa_clave', 'tfa_descrip')->get();
                 $sheet->fromArray($billings);
             });
         })->download('csv');
     }

     public function billingsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/terminos-facturacion.csv');
     }

     public function billingsImport(BillingImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
 					$insert[] = ['tfa_clave' => $value->tfa_clave, 'tfa_descrip' => $value->tfa_descrip];
 				}
                 if(!empty($insert))
                 {
                     \DB::table('mdb_tfactura')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.billings.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Destinos de Mercancia
      */

     public function destinations()
     {
         $destinations = Destination::paginate(15);
         return view('Qore.catalogs.destinations.index', compact('destinations'));
     }

     public function destinationStore(DestinationRequest $request)
     {
         Destination::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.destinations.index');
     }

     public function destinationEdit(Destination $destination)
     {
         return view('Qore.catalogs.destinations.edit', compact('destination'));
     }

     public function destinationUpdate(Destination $destination, DestinationRequest $request)
     {
         $destination->fill($request->all());
         $destination->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.destinations.index');
     }

     public function destinationDestroy(Destination $destination, Request $request)
     {
         $destination->delete();
         $destination->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.destinations.index');
     }

     public function destinationsExport()
     {
         Excel::create('destinos-mercancia', function($excel){
             $excel->sheet('Destinos de Mercancia', function($sheet){
                 $destinations = Destination::select('des_clave', 'des_descrip')->get();
                 $sheet->fromArray($destinations);
             });
         })->download('csv');
     }

     public function destinationsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/destinos-mercancia.csv');
     }

     public function destinationsImport(DestinationImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
 					$insert[] = ['des_clave' => $value->des_clave, 'des_descrip' => $value->des_descrip];
 				}
                 if(!empty($insert))
                 {
                     \DB::table('mdb_destinos')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.destinations.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Regimenes
      */

     public function regimens()
     {
         $regimens = Regimen::paginate(15);
         return view('Qore.catalogs.regimens.index', compact('regimens'));
     }

     public function regimenStore(RegimenRequest $request)
     {
         Regimen::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.regimens.index');
     }

     public function regimenEdit(Regimen $regimen)
     {
         return view('Qore.catalogs.regimens.edit', compact('regimen'));
     }

     public function regimenUpdate(Regimen $regimen, RegimenRequest $request)
     {
         $regimen->fill($request->all());
         $regimen->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.regimens.index');
     }

     public function regimenDestroy(Regimen $regimen, Request $request)
     {
         $regimen->delete();
         $regimen->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.regimens.index');
     }

     public function regimensExport()
     {
         Excel::create('regimenes', function($excel){
             $excel->sheet('Regimenes', function($sheet){
                 $regimens = Regimen::select('reg_clave', 'reg_descrip')->get();
                 $sheet->fromArray($regimens);
             });
         })->download('csv');
     }

     public function regimensDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/regimenes.csv');
     }

     public function regimensImport(RegimenImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
 					$insert[] = ['reg_clave' => $value->reg_clave, 'reg_descrip' => $value->reg_descrip];
 				}
                 if(!empty($insert))
                 {
                     \DB::table('mdb_regimen')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.regimens.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Pedimentos y Consolidados
      */

     public function consolids()
     {
         $consolids = Consolid::paginate(15);
         return view('Qore.catalogs.consolids.index', compact('consolids'));
     }

     public function consolidStore(ConsolidRequest $request)
     {
         Consolid::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.consolids.index');
     }

     public function consolidEdit(Consolid $consolid)
     {
         return view('Qore.catalogs.consolids.edit', compact('consolid'));
     }

     public function consolidUpdate(Consolid $consolid, ConsolidRequest $request)
     {
         $consolid->fill($request->all());
         $consolid->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.consolids.index');
     }

     public function consolidDestroy(Consolid $consolid, Request $request)
     {
         $consolid->delete();
         $consolid->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.consolids.index');
     }

     public function consolidsExport()
     {
         Excel::create('pedimentos-consolidados', function($excel){
             $excel->sheet('Pedimentos y Consolidados', function($sheet){
                 $consolids = Consolid::select('con_campo', 'con_tipo', 'con_valor')->get();
                 $sheet->fromArray($consolids);
             });
         })->download('csv');
     }

     public function consolidsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/pedimentos-consolidados.csv');
     }

     public function consolidsImport(ConsolidImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['con_campo' => $value->con_campo, 'con_tipo' => $value->con_tipo, 'con_valor' => $value->con_valor];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_consolid')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.consolids.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Tipos de Tasas
      */

     public function rates()
     {
         $rates = Rate::paginate(15);
         return view('Qore.catalogs.rates.index', compact('rates'));
     }

     public function rateStore(RateRequest $request)
     {
         Rate::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.rates.index');
     }

     public function rateEdit(Rate $rate)
     {
         return view('Qore.catalogs.rates.edit', compact('rate'));
     }

     public function rateUpdate(Rate $rate, RateRequest $request)
     {
         $rate->fill($request->all());
         $rate->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.rates.index');
     }

     public function rateDestroy(Rate $rate, Request $request)
     {
         $rate->delete();
         $rate->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.rates.index');
     }

     public function ratesExport()
     {
         Excel::create('tipos-tasas', function($excel){
             $excel->sheet('Tipos de Tasas', function($sheet){
                 $rates = Rate::select('tas_clave', 'tas_descrip')->get();
                 $sheet->fromArray($rates);
             });
         })->download('csv');
     }

     public function ratesDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/tipos-tasas.csv');
     }

     public function ratesImport(RateImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['tas_clave' => $value->tas_clave, 'tas_descrip' => $value->tas_descrip];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_tasas')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.rates.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Clasificacion de Sustancias
      */

     public function substances()
     {
         $substances = Substance::paginate(15);
         return view('Qore.catalogs.substances.index', compact('substances'));
     }

     public function substanceStore(SubstanceRequest $request)
     {
         Substance::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.substances.index');
     }

     public function substanceEdit(Substance $substance)
     {
         return view('Qore.catalogs.substances.edit', compact('substance'));
     }

     public function substanceUpdate(Substance $substance, SubstanceRequest $request)
     {
         $substance->fill($request->all());
         $substance->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.substances.index');
     }

     public function substanceDestroy(Substance $substance, Request $request)
     {
         $substance->delete();
         $substance->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.substances.index');
     }

     public function substancesExport()
     {
         Excel::create('clasificacion-sustancias', function($excel){
             $excel->sheet('Clasificación de Sustancias', function($sheet){
                 $substances = Substance::select('sus_clase', 'sus_denomina')->get();
                 $sheet->fromArray($substances);
             });
         })->download('csv');
     }

     public function substancesDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/clasificacion-sustancias.csv');
     }

     public function substancesImport(SubstanceImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['sus_clase' => $value->sus_clase, 'sus_denomina' => $value->sus_denomina];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_sustanci')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.substances.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Recintos Fiscalizados Estrategicos
      */

     public function strategics()
     {
         $aduanas = Aduana::pluck('adu_denomina', 'id');
         $strategics = Strategic::paginate(15);
         return view('Qore.catalogs.strategics.index', compact('strategics', 'aduanas'));
     }

     public function strategicStore(StrategicRequest $request)
     {
         Strategic::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.strategics.index');
     }

     public function strategicEdit(Strategic $strategic)
     {
         $aduanas = Aduana::pluck('adu_denomina', 'id');
         return view('Qore.catalogs.strategics.edit', compact('strategic', 'aduanas'));
     }

     public function strategicUpdate(Strategic $strategic, StrategicRequest $request)
     {
         $strategic->fill($request->all());
         $strategic->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.strategics.index');
     }
     public function strategicDestroy(Strategic $strategic, Request $request)
     {
         $strategic->delete();
         $strategic->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.strategics.index');
     }

     public function strategicsExport()
     {
         Excel::create('recintos-estrategicos', function($excel){
             $excel->sheet('Recintos Estrategicos', function($sheet){
                 $strategics = Strategic::select('rec_clave', 'rec_nombre', 'rec_aduana')->get();
                 $sheet->fromArray($strategics);
             });
         })->download('csv');
     }

     public function strategicsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/recintos-estrategicos.csv');
     }

     public function strategicsImport(StrategicImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['rec_clave' => $value->rec_clave, 'rec_nombre' => $value->rec_nombre, 'rec_aduana' => $value->rec_aduana];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_recintos')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.strategics.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo OMA Unidades de Medida
      */

     public function omaunits()
     {
         $omaunits = OMAUnit::paginate(15);
         return view('Qore.catalogs.omaunits.index', compact('omaunits'));
     }

     public function omaunitStore(OMAUnitRequest $request)
     {
         OMAUnit::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.omaunits.index');
     }

     public function omaunitEdit(OMAUnit $omaunit)
     {
         return view('Qore.catalogs.omaunits.edit', compact('omaunit'));
     }

     public function omaunitUpdate(OMAUnit $omaunit, OMAUnitRequest $request)
     {
         $omaunit->fill($request->all());
         $omaunit->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.omaunits.index');
     }

     public function omaunitDestroy(OMAUnit $omaunit, Request $request)
     {
         $omaunit->delete();
         $omaunit->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.omaunits.index');
     }

     public function omaunitsExport()
     {
         Excel::create('oma-unidades-medida', function($excel){
             $excel->sheet('Unidades de Medida', function($sheet){
                 $omaunits = OMAUnit::select('oma_clave', 'oma_nombre')->get();
                 $sheet->fromArray($omaunits);
             });
         })->download('csv');
     }

     public function omaunitsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/oma-unidades-medida.csv');
     }

     public function omaunitsImport(OMAUnitImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['oma_clave' => $value->oma_clave, 'oma_nombre' => $value->oma_nombre];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_omaumedida')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.omaunits.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo OMA Claves de Monedas
      */

     public function omacurrencies()
     {
         $omacurrencies = OMACurrency::paginate(15);
         return view('Qore.catalogs.omacurrencies.index', compact('omacurrencies'));
     }

     public function omacurrencyStore(OMACurrencyRequest $request)
     {
         OMACurrency::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.omacurrencies.index');
     }

     public function omacurrencyEdit(OMACurrency $omacurrency)
     {
         return view('Qore.catalogs.omacurrencies.edit', compact('omacurrency'));
     }

     public function omacurrencyUpdate(OMACurrency $omacurrency, OMACurrencyRequest $request)
     {
         $omacurrency->fill($request->all());
         $omacurrency->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.omacurrencies.index');
     }

     public function omacurrencyDestroy(OMACurrency $omacurrency, Request $request)
     {
         $omacurrency->delete();
         $omacurrency->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.omacurrencies.index');
     }

     public function omacurrenciesExport()
     {
         Excel::create('oma-claves-moneda', function($excel){
             $excel->sheet('Claves de Monedas', function($sheet){
                 $omacurrencies = OMACurrency::select('oma_clave', 'oma_nombre', 'oma_pais')->get();
                 $sheet->fromArray($omacurrencies);
             });
         })->download('csv');
     }

     public function omacurrenciesDownload()
     {
        return response()->download('apps/qore/administration/catalogs/oficials/oma-claves-moneda.csv');
     }

     public function omacurrenciesImport(OMACurrencyImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['oma_clave' => $value->oma_clave, 'oma_nombre' => $value->oma_nombre, 'oma_pais' => $value->oma_pais];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_omamonedas')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.omacurrencies.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo OMA Claves de Monedas
      */

     public function factors()
     {
         $factors = Factor::paginate(15);
         return view('Qore.catalogs.factors.index', compact('factors'));
     }

     public function factorStore(FactorRequest $request)
     {
         Factor::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.factors.index');
     }

     public function factorEdit(Factor $factor)
     {
         return view('Qore.catalogs.factors.edit', compact('factor'));
     }

     public function factorUpdate(Factor $factor, FactorRequest $request)
     {
         $factor->fill($request->all());
         $factor->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.factors.index');
     }

     public function factorDestroy(Factor $factor, Request $request)
     {
         $factor->delete();
         $factor->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.factors.index');
     }

     public function factorsExport()
     {
         Excel::create('factor-moneda', function($excel){
             $excel->sheet('Factor Moneda Ext', function($sheet){
                 $factors = Factor::select('fmo_moneda', 'fmo_equival', 'fmo_fecha')->get();
                 $sheet->fromArray($factors);
             });
         })->download('csv');
     }

     public function factorsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/factor-moneda.csv');
     }

     public function factorsImport(FactorImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['fmo_moneda' => $value->fmo_moneda, 'fmo_equival' => $value->fmo_equival, 'fmo_fecha' => $value->fmo_fecha];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_fmonext')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.factors.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo OMA Claves de Monedas
      */

     public function changes()
     {
         $changes = Change::paginate(15);
         return view('Qore.catalogs.changes.index', compact('changes'));
     }

     public function changeStore(ChangeRequest $request)
     {
         Change::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.changes.index');
     }

     public function changeEdit(Change $change)
     {
         return view('Qore.catalogs.changes.edit', compact('change'));
     }

     public function changeUpdate(Change $change, ChangeRequest $request)
     {
         $change->fill($request->all());
         $change->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.changes.index');
     }

     public function changeDestroy(Change $change, Request $request)
     {
         $change->delete();
         $change->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.changes.index');
     }

     public function changesExport()
     {
         Excel::create('tipo-cambio', function($excel){
             $excel->sheet('Tipos de Cambio', function($sheet){
                 $changes = Change::select('tpc_value', 'tpc_fecha')->get();
                 $sheet->fromArray($changes);
             });
         })->download('csv');
     }

     public function changesDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/tipo-cambio.csv');
     }

     public function changesImport(ChangeImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['tpc_value' => $value->tpc_value, 'tpc_fecha' => $value->tpc_fecha];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_tipocambio')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.changes.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Indice Nacional del Precio al Consumidor
      */

     public function inpc()
     {
         $inpc = INPC::paginate(15);
         return view('Qore.catalogs.inpc.index', compact('inpc'));
     }

     public function inpcStore( INPCRequest $request)
     {
         INPC::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.inpc.index');
     }

     public function inpcEdit(INPC $inpc)
     {
         return view('Qore.catalogs.inpc.edit', compact('inpc'));
     }

     public function inpcUpdate(INPC $inpc, INPCRequest $request)
     {
         $inpc->fill($request->all());
         $inpc->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.inpc.index');
     }

     public function inpcDestroy(INPC $inpc, Request $request)
     {
         $inpc->delete();
         $inpc->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.inpc.index');
     }

     public function inpcExport()
     {
         Excel::create('inpc', function($excel){
             $excel->sheet('Indice Nac Precio', function($sheet){
                 $inpc = INPC::select('inp_anio', 'inp_periodo', 'inp_valor', 'inp_recargo')->get();
                 $sheet->fromArray($inpc);
             });
         })->download('csv');
     }

     public function inpcDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/inpc.csv');
     }

     public function inpcImport(INPCImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['inp_anio' => $value->inp_anio, 'inp_periodo' => $value->inp_periodo, 'inp_valor' => $value->inp_valor, 'inp_recargo' => $value->inp_recargo];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_inpc')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.inpc.index');
                 }
             }
         }
         return back();
     }

     /*
      * Catalogo Fraccion Arancelaria
      */

     public function fractions()
     {
         $fractions = Fraction::paginate(15);
         return view('Qore.catalogs.fractions.index', compact('fractions'));
     }

     public function fractionStore(FractionRequest $request)
     {
         Fraction::create($request->all());
         Session::flash('mesagge', 'Registro exitoso!!');
         return redirect()->route('qore.catalogs.fractions.index');
     }

     public function fractionEdit(Fraction $fraction)
     {
         return view('Qore.catalogs.fractions.edit', compact('fraction'));
     }

     public function fractionUpdate(Fraction $fraction, FractionRequest $request)
     {
         $fraction->fill($request->all());
         $fraction->save();
         Session::flash('message', 'Edición exitosa!!');
         return redirect()->route('qore.catalogs.fractions.index');
     }

     public function fractionDestroy(Fraction $fraction, Request $request)
     {
         $fraction->delete();
         $fraction->restore();
         if($request->ajax())
         {
             return response()->json(['message' => "Borrado exitoso!!"]);
         }
         Session::flash('message', 'Borrado exitoso!!');
         return redirect()->route('qore.catalogs.fractions.index');
     }

     public function fractionsExport()
     {
         Excel::create('fracciones-arancelarias', function($excel){
             $excel->sheet('Fracciones Arancelarias', function($sheet){
                 $fractions = Fraction::select("fra_fraccion", "fra_descrip1", "fra_descrip2", "fra_descrip3", "fra_unidad", "fra_advotr")->get();
                 $sheet->fromArray($fractions);
             });
         })->download('csv');
     }

     public function fractionsDownload()
     {
         return response()->download('apps/qore/administration/catalogs/oficials/fracciones-arancelarias.csv');
     }

     public function fractionsImport(FractionImportRequest $request)
     {
         if($request->hasFile('file'))
         {
             $path = $request->file('file')->getRealPath();
             $data = Excel::load($path, function($render){
             })->get();
             if(!empty($data) && $data->count())
             {
                 foreach ($data as $key => $value) {
                   $insert[] = ['fra_fraccion' => $value->fra_fraccion, 'fra_descrip1' => $value->fra_descrip1, 'fra_descrip2' => $value->fra_descrip2, 'fra_descrip3' => $value->fra_descrip3, 'fra_unidad' => $value->fra_unidad, 'fra_advotr' => $value->fra_advotr];
               }
                 if(!empty($insert))
                 {
                     \DB::table('mdb_fraccion')->insert($insert);
                     Session::flash('message', 'Importación de datos exitosa!!');
                     return redirect()->route('qore.catalogs.fractions.index');
                 }
             }
         }
         return back();
     }

}
