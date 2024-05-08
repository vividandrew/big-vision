<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\User;
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

    function orders()
    {
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
        $users = User::all();
        return view('admin.users')->with('users', $users);
    }
}
