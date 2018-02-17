<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function index()
    {
        return view('Sentry.accounts.index');
    }
}
