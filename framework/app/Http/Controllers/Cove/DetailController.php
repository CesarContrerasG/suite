<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\DetailRequest;
use App\Cove\Detail;

class DetailController extends Controller
{
    public function store(DetailRequest $request)
    {
        $detail = new Detail;
        Detail::insertOrUpdate($detail, $request);

        return redirect()->back();
    }


    public function update(Detail $detail, DetailRequest $request)
    {
        Detail::insertOrUpdate($detail, $request);

        return redirect()->back();
    }
}