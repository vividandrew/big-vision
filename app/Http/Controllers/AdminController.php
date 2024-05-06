<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.index');
    }

    function products()
    {
        $products = Product::all();
        return view('admin.products')->with('products', $products);
    }
}
