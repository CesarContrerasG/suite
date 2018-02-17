<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\ConsultationRequest;
use App\Cove\Consultation;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::all();
        $type = auth()->user()->permission_cove;

        return view('Cove.consultations.index')->with(['consultations' => $consultations, 'type' => $type]);
    }

    public function create()
    {    
        return view('Cove.consultations.create');
    }

    public function store(ConsultationRequest $request)
    {
        $consultation = new Consultation;
        Consultation::insertOrUpdate($consultation, $request);

        return redirect()->route('cove.consultations.index');
    }

    public function  edit(Consultation $consultation)
    {          
        return view('Cove.consultations.edit')->with('consultation', $consultation);
    }

    public function update(Consultation $consultation, ConsultationRequest $request)
    {
        Consultation::insertOrUpdate($consultation, $request);

        return redirect()->route('cove.consultations.index');
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return response()->json(['redirect' => 'consultations']);
    }
}