<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StorageController extends Controller
{
    public function index(){
        return view('Platform.storage.index', compact('configuration'));
    }
}
