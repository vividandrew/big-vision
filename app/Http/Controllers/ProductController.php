<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('product.index', compact('products'))->with(request()->input('page'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'Name' => 'required',
           'Price' => 'required',
           'Stock' => 'required',
           'Barcode' => 'nullable',
           'Platform' => 'nullable',
           'Discount' => 'nullable',
            'ImageUrl' => 'nullable'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');//->with('success', 'Product Created successfully');
    }

    public function show($id)
    {
        $product = Product::whereId($id)->firstOrFail();

        return view('product.details')->with('product', $product);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
