<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sentry\Configuration;
use App\Helpers;

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
    public function catalogs()
    {
        $configuration = Configuration::where('master_id', auth()->user()->master_id)->first();
        $catalogs = Helpers::getOficialsCatalogs();
        return view('Platform.catalogs.index', compact('configuration', 'catalogs'));
    }

    public function appendixOne()
    {
        $aduanas = Aduana::all();
        return view('Platform.catalogs.oficials.appendixOne', compact('aduanas'));
    }

    public function appendixTwo()
    {
        $claves = CPedimento::all();
        return view('Platform.catalogs.oficials.appendixTwo', compact('claves'));
    }

    public function appendixThree()
    {
        $transports = Transport::all();
        return view('Platform.catalogs.oficials.appendixThree', compact('transports'));
    }

    public function appendixFour()
    {
        $countries = Country::all();
        return view('Platform.catalogs.oficials.appendixFour', compact('countries'));
    }

    public function appendixFive()
    {
        $currencies = Currency::all();
        return view('Platform.catalogs.oficials.appendixFive', compact('currencies'));
    }

    public function appendixSix()
    {
        $enclosures = Enclosure::all();
        return view('Platform.catalogs.oficials.appendixSix', compact('enclosures'));
    }

    public function appendixSeven()
    {
        $units = Unit::all();
        return view('Platform.catalogs.oficials.appendixSeven', compact('units'));
    }

    public function appendixEight()
    {
        $identifiers = Identifier::all();
        return view('Platform.catalogs.oficials.appendixEight', compact('identifiers'));
    }

    public function appendixNine()
    {
        $regularizations = Regularization::all();
        return view('Platform.catalogs.oficials.appendixNine', compact('regularizations'));
    }

    public function appendixTen()
    {
        $containers = Container::all();
        return view('Platform.catalogs.oficials.appendixTen', compact('containers'));
    }

    public function appendixEleven()
    {
        $valuations = Valuation::all();
        return view('Platform.catalogs.oficials.appendixEleven', compact('valuations'));
    }

    public function appendixTwelve()
    {
        $contributions = Contribution::all();
        return view('Platform.catalogs.oficials.appendixTwelve', compact('contributions'));
    }

    public function appendixThirteen()
    {
        $payments = Payment::all();
        return view('Platform.catalogs.oficials.appendixThirteen', compact('payments'));
    }

    public function appendixFourteen()
    {
        $billings = Billing::all();
        return view('Platform.catalogs.oficials.appendixFourteen', compact('billings'));
    }

    public function appendixFifTeen()
    {
        $destinations = Destination::all();
        return view('Platform.catalogs.oficials.appendixFifteen', compact('destinations'));
    }

    public function appendixSixteen()
    {
        $regimenes = Regimen::all();
        return view('Platform.catalogs.oficials.appendixSixteen', compact('regimenes'));
    }

    public function appendixSeventeen()
    {
        $consolids = Consolid::all();
        return view('Platform.catalogs.oficials.appendixSeventeen', compact('consolids'));
    }

    public function appendixEighteen()
    {
        $rates = Rate::all();
        return view('Platform.catalogs.oficials.appendixEighteen', compact('rates'));
    }

    public function appendixNineteen()
    {
        $substances = Substance::all();
        return view('Platform.catalogs.oficials.appendixNineteen', compact('substances'));
    }

    public function appendixTwentyone()
    {
        $strategics = Strategic::all();
        return view('Platform.catalogs.oficials.appendixTwentyone', compact('strategics'));
    }

    public function omaUnits()
    {
        $units = OMAUnit::all();
        return view('Platform.catalogs.oficials.omaUnits', compact('units'));
    }

    public function omaCurrencies()
    {
        $currencies = OMACurrency::all();
        return view('Platform.catalogs.oficials.omaCurrencies', compact('currencies'));
    }

    public function omaFactor()
    {
        $factors = Factor::all();
        return view('Platform.catalogs.oficials.omaFactor', compact('factors'));
    }

    public function omaChange()
    {
        $changes = Change::all();
        return view('Platform.catalogs.oficials.omaChange', compact('changes'));
    }

    public function omaINPC()
    {
        $inpcs = INPC::all();
        return view('Platform.catalogs.oficials.omaINPC', compact('inpcs'));
    }

    public function omaFraccion()
    {
        $fractions = Fraction::paginate(10);
        return view('Platform.catalogs.oficials.omaFraccion', compact('fractions'));
    }
}
