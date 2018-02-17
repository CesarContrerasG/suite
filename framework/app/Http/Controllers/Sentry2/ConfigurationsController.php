<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setup\ConfigurationsRequest;
use App\Sentry\Master;
use App\Sentry\Configuration;

class ConfigurationsController extends Controller
{
    public function create(Master $master)
    {
        $configuration = Configuration::where('master_id', $master->id)->first();
        $clients = [0 => 'Misma Cuenta'];
        foreach ($master->clients as $client)
        {
            $clients[$client->id] = $client->name;
        }
        return view('Sentry.configurations.form', compact('master', 'configuration', 'clients'));
    }

    public function store(Master $master, ConfigurationsRequest $request)
    {
        Configuration::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('sentry.masters.index');
    }

    public function update(Master $master, Configuration $configuration, ConfigurationsRequest $request)
    {
        $configuration->fill($request->all());
        $configuration->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('sentry.masters.index');
    }
}
