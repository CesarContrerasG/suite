<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\PatentRequest;
use App\Cove\Patent;

class PatentController extends Controller
{
    public function index()
    {
        $patents = Patent::all();
        $type = auth()->user()->permission_cove;

        return view('Cove.patents.index')->with(['patents' => $patents, 'type' => $type]);
    }

    public function create()
    {    
        return view('Cove.patents.create');
    }

    public function store(PatentRequest $request)
    {
        $patent = new Patent;
        Patent::insertOrUpdate($patent, $request);

        return redirect()->route('cove.patents.index');
    }

    public function  edit(Patent $patent)
    {          
        return view('Cove.patents.edit')->with('patent', $patent);
    }

    public function update(Patent $patent, PatentRequest $request)
    {
        Patent::insertOrUpdate($patent, $request);

        return redirect()->route('cove.patents.index');
    }

    public function destroy(Patent $patent)
    {
        $patent->delete();

        return response()->json(['redirect' => 'patents']);
    }
}