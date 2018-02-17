<?php
namespace App\Http\Controllers\Recove;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Recove\Pedimento;
class AdminController extends Controller
{
    public function index()
    {
        $pedimentos = Pedimento::where('origen',1)->paginate(7);
        return view('Recove.admin')->with('pedimentos',$pedimentos);
    }
}