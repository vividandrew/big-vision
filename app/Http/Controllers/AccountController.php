<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function login()
    {
        return view('account.login');
    }

    public function verify()
    {
        return redirect()->route('home.index');
    }

    public function register()
    {
        return view('account.register');
    }

    public function updateAddress($request)
    {

        $request->validate([
            'AddressLine1' => 'required',
            'AddressLine2' => 'required',
            'Stock' => 'required',
            'Barcode' => 'nullable',
            'Platform' => 'nullable',
            'Discount' => 'nullable'
        ]);
        $request->user()->fill($request->validated());
        return Redirect::route('profile.edit')->with('status', 'address-updated');
    }
}
