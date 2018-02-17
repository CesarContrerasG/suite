<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\MaterialRequest;
use App\Cove\Material;
use Yajra\Datatables\Datatables;


class MaterialController extends Controller
{
    public function index()
    {
        $type = auth()->user()->permission_cove;
        return view('Cove.materials.index')->with('type', $type);
    }

    public function getMaterials()
    {
        $materials = Material::select('pk_item', 'pk_mat', 'mat_descove','mat_fracci','mat_tipo','mat_oma');
 
        return Datatables::of($materials)
            ->addColumn('options', function($material){
                return '<div class="dropdown">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Opciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-catalog">
                                <li><a href="'.route('cove.materials.edit', $material->pk_item).'">Editar</a></li>
                                <li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="materials/'. $material->pk_item .'/destroy" data-token="'.csrf_token().'">Eliminar</a></li>                                                          
                            </ul>
                        </div>';
            })->make(true);

    }

    public function create()
    {    
        return view('Cove.materials.create');
    }

    public function store(MaterialRequest $request)
    {
        $material = new Material;
        Material::insertOrUpdate($material, $request);

        return redirect()->route('cove.materials.index');
    }

    public function  edit(Material $material)
    {                
        return view('Cove.materials.edit')->with('material', $material);
    }

    public function update(Material $material, MaterialRequest $request)
    {
        Material::insertOrUpdate($material, $request);

        return redirect()->route('cove.materials.index');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return response()->json(['redirect' => 'materials']);
    }
}