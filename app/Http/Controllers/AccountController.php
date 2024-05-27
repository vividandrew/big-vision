<?php

namespace App\Http\Controllers;

use App\External\Role;
use App\Models\Customer;
use App\Models\User;
use App\Models\Visionary;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function dashboard()
    {
            if(Auth::user()->role != "Customer")
            {
                return view('admin.index');
            }
            return view('account.dashboard');
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

    public function edit($id)
    {
        $user = User::whereId($id)->first();
        if($user == null) return redirect()->view('admin.index');
        $Roles = (new Role)->GetRoles();

        return view('account.edit')->with('user', $user)->with('Roles', $Roles);
    }

    public function editPost(Request $request, $id)
    {
        $user = User::whereId($id)->first();
        $request->validate([
            'role' => 'required',
        ]);

        $role = new Role();

        $role->setRoleById($request['role']);

        //This checks if there has been a change to role before sending request to database
        if($user->role != $role->getRole())
        {
            $user->role = $role->getRole();
            $user->save();
        }

        return redirect()->route('admin.index');
    }

    public function registerLoyalty()
    {
        $visionary = new Visionary([
            'LoyaltyNo' => Auth::user()->name.Carbon::now(),
            'LoyaltyPoints' => 0,
            'CustomerId' => Auth::user()->id,
        ]);

        $visionary::create($visionary->allDb());

        return redirect()->route('home.index');
    }
}
