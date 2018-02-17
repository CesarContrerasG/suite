<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\ProductRequest;
use App\Cove\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $type = auth()->user()->permission_cove;

        return view('Cove.products.index')->with(['products' => $products, 'type' => $type]);
    }

    public function create()
    {    
        return view('Cove.products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = new Product;
        Product::insertOrUpdate($product, $request);

        return redirect()->route('cove.products.index');
    }

    public function  edit(Product $product_cove)
    {          
        return view('Cove.products.edit')->with('product', $product_cove);
    }

    public function update(Product $product, ProductRequest $request)
    {
        Product::insertOrUpdate($product, $request);

        return redirect()->route('cove.products.index');
    }

    public function destroy(Product $product_cove)
    {
        $product_cove->delete();

        return response()->json(['redirect' => 'products']);
    }
}