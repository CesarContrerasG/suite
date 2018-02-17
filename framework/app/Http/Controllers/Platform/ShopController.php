<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
         return view('Platform.shop.index', compact('configuration'));
    }
}
