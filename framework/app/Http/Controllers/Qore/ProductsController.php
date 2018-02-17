<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Qore\ProductRequest;
use App\Qore\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::getValidProducts();
        return view('Qore.products.index', compact('products'));
    }

    public function create()
    {
        return view('Qore.products.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->all());
        Session::flash('message', 'Registrado exitoso');
        return redirect()->route('qore.products.index');
    }

    public function edit(Product $product)
    {
        return view('Qore.products.edit', compact('product'));
    }

    public function update(Product $product, ProductRequest $request)
    {
        $product->fill($request->all());
        $product->save();
        Session::flash('message', 'Edición exitosa');
        return redirect()->route('qore.products.index');
    }

    public function destroy(Product $product, Request $request)
    {
        $product->delete();
    	return response()->json(['redirect' => 'products']);
    }

    public function disabled(Product $product)
    {
        Product::toggleStatus($product);
    	return redirect()->back();
    }
}
