<?php

namespace App\Http\Controllers;

use App\External\Role;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
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
        $loyaltyUser = Visionary::where('CustomerId', $user->id)->first();
        if($loyaltyUser == null)
        {
            $request->validate([
                'role' => 'required',
            ]);
        }else{
            $request->validate([
                'role' => 'required',
                'points' => 'required',
            ]);
        }

        $role = new Role();

        $role->setRoleById($request['role']);

        //This checks if there has been a change to role before sending request to database
        if($user->role != $role->getRole())
        {
            $user->role = $role->getRole();
            $user->save();
        }


        if($loyaltyUser != null)
        {
            //Checks if the value has changed then updates the database
            if($loyaltyUser->LoyaltyPoints != $request['points'])
            {
                $loyaltyUser->LoyaltyPoints = $request['points'];
                $loyaltyUser->save();
            }
        }

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $user = Auth::user(); //Assign logged in user to variable user

        //Authentication to ensure the logged in user can access this section
        if($user == null){return redirect('/');}
        if($user->role == "Warehouse"){return redirect()->route('admin.index');}

        //This is for user deletion
        if($user->role == "Customer" && $user->id != $id){return redirect('/');}

        $dUser = User::whereId($id);

        //Failsafe if user doesn't exist
        if($dUser == null){return redirect()->route('admin.users');}

        //Check that store staff is only trying to delete Customers, only managers and admins can delete staff members
        if($user->role == "Store" && $dUser != "Customer"){return redirect()->route('admin.index');}

        //Delete all associated items for the user
        foreach(Order::all()->where('CustomerId', $dUser->id) as $order)
        {
            foreach(OrderLine::whereOrderId($order->id) as $ol)
            {
                $ol->delete();
            }
            $order->delete();
        }

        //Delete all appointments made by the user
        foreach(Appointment::whereCustomerid($dUser->id) as $app)
        {
            $app->delete();
        }

        //Delete loyalty membership
        $loyalty = Visionary::whereUserId($dUser->id)->first();
        if($loyalty != null){$loyalty->delete();}

        //this is executed if the user deletes themselves
        if($user->id == $dUser->id)
        {
            $dUser->delete();
            return redirect('/');
        }
        $dUser->delete(); //Final deletion of the user
        return redirect()->route('admin.users');
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
