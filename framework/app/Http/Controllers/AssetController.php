<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\AssetRequest;
use App\Cove\Asset;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::all();

        return view('Cove.assets.index')->with('assets', $assets);
    }

    public function create()
    {    
        return view('Cove.assets.create');
    }

    public function store(AssetRequest $request)
    {
        $asset = new Asset;
        Asset::insertOrUpdate($asset, $request);

        return redirect()->route('cove.assets.index');
    }

    public function  edit(Asset $asset)
    {                
        return view('Cove.assets.edit')->with('asset', $asset);
    }

    public function update(Asset $asset, AssetRequest $request)
    {
        Asset::insertOrUpdate($asset, $request);

        return redirect()->route('cove.assets.index');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return response()->json(['redirect' => 'assets']);
    }
}