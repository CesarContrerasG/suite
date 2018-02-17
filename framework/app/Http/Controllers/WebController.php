<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;

class WebController extends Controller 
{
    public function index(){
        return view('welcome');
    }

    public function registerToNewsletter(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        Newsletter::subscribe($email, ['FNAME' => $name]);

        return response()->json(['name' => $name, 'mail' => $email]);
    }
}