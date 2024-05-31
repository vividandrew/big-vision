<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        //Checks to ensure only select users of roles can access the admin dashboard
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        return view('admin.index');
    }

    function products()
    {
        //Checks to ensure only those with select roles can access the products section
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Store"){return redirect()->route('admin.index');}

        $products = Product::all();
        return view('admin.products')->with('products', $products);
    }

    function orders()
    {
        //Checks to ensure only those with select roles can access the orders section
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}

        //orders are created to hold basket items in the database, instead of having it separate.
        //this query only pulls orders that aren't still in basket and yet to be ordered
        $orders = Order::all()->whereNotIn('Status', 'Basket');

        //This is a loop through each order and filling the class in with the
        //relevant information to be used on the front end with views
        foreach($orders as $order)
        {
            foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
            {
                $ol->product = Product::whereId($ol->ProductId)->first();
                array_push($order->OrderLines, $ol);
            }
        }

        return view('admin.orders')->with('orders', $orders);
    }

    function users()
    {
        //Checks to ensure only those with select roles can view all users
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}

        //if the users role is staff, only serve customers else serve all users
        if(Auth::user()->role == "Store")
        {
            $users = User::all()->where('role', 'Customer');
        }else{
            $users = User::all();
        }
        return view('admin.users')->with('users', $users);
    }

    public function printEOD()
    {
        //Checks to ensure only those with select roles can view the end of day report
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}

        $pdf = new Dompdf();
        $pdf->loadHtml(view('admin.eod'));//grabs the eod view as a html document to be served as pdf
        $pdf->setPaper('A4', 'landscape');

        $pdf->render(); //renders the styling on the html

        return $pdf->stream(); //streams file directly to the user that will download automatically
    }

    function appointments()
    {
        //Checks to ensure only those with select roles can view all appointments
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}


        $appointments = Appointment::all();
        return view('admin.appointments')->with('appointments', $appointments);
    }
}
