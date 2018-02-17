<?php
namespace App\Http\Controllers\Recove;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ConnectionDB;

class PathController extends Controller
{
	public function index()
	{
        $emp = ConnectionDB::changeConnection();
		$path = \DB::connection('mysql')->table('config_dir')->where('company',$emp)->first();
		
		return view('Recove.download')->with('path',$path);
	}
    public function store(Request $request)
    {
    	$emp = ConnectionDB::changeConnection();
    	$data = [
    		'ftp' => $request->get('ftp'),
    		'user' => $request->get('user'),
    		'password' => $request->get('password'),
    		'company' => $emp
    	];
    	\DB::connection('mysql')->table('config_dir')->insert($data);
    	return redirect()->back();
    }
    public function update(Request $request, $id)
    {
    	$emp = ConnectionDB::changeConnection();
    	$data = [
    		'type' => $request->get('type'), 
    		'ftp' => $request->get('ftp'),
    		'user' => $request->get('user'),
    		'password' => $request->get('password'),
    		'company' => $emp
    	];
    	\DB::connection('mysql')->table('config_dir')->where('id',$id)->update($data);
    	return redirect()->back();
    }
}