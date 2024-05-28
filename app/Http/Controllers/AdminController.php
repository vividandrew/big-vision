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
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        return view('admin.index');
    }

    function products()
    {
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Store"){return redirect()->route('admin.index');}

        $products = Product::all();
        return view('admin.products')->with('products', $products);
    }

    function orders()
    {
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}
        $orders = Order::all()->whereNotIn('Status', 'Basket');
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

    function orderEdit($id)
    {
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}
        $order = Order::whereId($id);
        foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
        {
            $ol->product = Product::whereId($ol->ProductId)->first();
            array_push($order->OrderLines, $ol);
        }
    }

    function orderEditPost(Request $request, $id)
    {

    }

    function users()
    {
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}

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
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}
        $pdf = new Dompdf();
        $pdf->loadHtml(view('admin.eod'));
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream();
    }

    function appointments()
    {
        if(Auth::user() == null){return redirect('/');}
        if(Auth::user()->role == "Customer"){return redirect('/');}
        if(Auth::user()->role == "Warehouse"){return redirect()->route('admin.index');}
        $appointments = Appointment::all();
        return view('admin.appointments')->with('appointments', $appointments);
    }
}
