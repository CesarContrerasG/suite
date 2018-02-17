<?php
namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests\Recove\PathRequest;
use App\Http\Controllers\Controller;
use App\ConnectionDB;
use App\Qore\Company;
use App\Recove\PathDownload;

class PathController extends Controller
{
	public function index()
	{
		$id_company = session()->get('company');
		$path = \DB::connection('mysql')->table('config_dir')->where('company', $id_company)->first();
		
		return view('Recove.download')->with('path', $path);
	}
    public function store(PathRequest $request)
    {
    	$data = PathDownload::fillData($request);
    	PathDownload::create($data);

    	return redirect()->back();
    }
    public function update(PathRequest $request, $id)
    {
    	$data = PathDownload::fillData($request);
    	PathDownload::where('id',$id)->update($data);

    	return redirect()->back();
    }
	
}