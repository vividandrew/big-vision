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
        //TODO::Set Authentication check
        return view('product.create');
    }

    public function store(Request $request)
    {
        //TODO::Set Authentication check
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
        //TODO::Set Authentication check
        $product = Product::whereId($id)->first();

        return view('product.update')->with('product', $product);
    }

    public function update(Request $request, $id)
    {
        //TODO::Set Authentication check

        $request->validate([
            'Name' => 'required',
            'Price' => 'required',
            'Stock' => 'required',
            'Barcode' => 'nullable',
            'Platform' => 'nullable',
            'Discount' => 'nullable',
            'ImageUrl' => 'nullable'
        ]);


        $product = Product::whereId($id)->first(); //grabs the product by id for comparison

        $change = false; // variable to check if product was changed

        // checks every variable to see if there is a difference, if so change it and set change variable to true
        if($product->Name != $request['Name']           && $request['Name'] != null)        $product->Name = $request['Name'];      $change = true;
        if($product->Price != $request['Price']         && $request['Price'] != null)       $product->Price = $request['Price'];     $change = true;
        if($product->Stock != $request['Stock']         && $request['Stock'] != null)       $product->Stock = $request['Stock'];     $change = true;
        if($product->Barcode != $request['Barcode'])                                        $product->Barcode = $request['Barcode'];   $change = true;
        if($product->Platform != $request['Platform'])                                      $product->Platform = $request['Platform'];  $change = true;
        if($product->Discount != $request['Discount'])                                      $product->Discount = $request['Discount'];  $change = true;
        if($product->ImageUrl != $request['ImageUrl'])                                      $product->ImageUrl = $request['ImageUrl'];  $change = true;

        //If change was made then send an update to the database, otherwise no update method is made
        if($change) $product->update();

        return redirect('/products/');

    }

    public function destroy($id)
    {
    }
}
