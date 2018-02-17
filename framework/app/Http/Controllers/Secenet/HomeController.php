<?php

namespace App\Http\Controllers\Secenet;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Qore\Company;

class HomeController extends Controller
{
    public function index()
    {

        return redirect()->to('http://162.249.2.34/sece/configuraciones/entrada.php?user='.urlencode(base64_encode(auth()->user()->name)).'&pass='.auth()->user()->password.'&company='.urlencode(base64_encode(auth()->user()->company_name)));
    }

}