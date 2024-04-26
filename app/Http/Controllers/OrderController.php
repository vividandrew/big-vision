<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user == null){return Redirect::route('home.index');}

        $order = Order::where('CustomerId', $user->id)->orderByDesc('created_at')->first();

        //Creates a new order if there isn't already an order in place
        if($order == false){ $order = new Order([
            'id' => 0,
            'OrderDate' => new DateTime(),
            'Status' => 'Basket',
            'OrderLines' => null,
            'CustomerId' => $user->id,
        ]);
            Order::create($order->allDB());
        }


        //$user->order = $order;

        return view('basket.index')->with('order', $order);
    }

    /*
     * Add Product to order
     */
    public function addProduct($id)
    {
        $user = Auth::user();

        if($user == null){return Redirect::route('home.index');}

        $order = Order::where('CustomerId', $user->id)->orderByDesc('created_at')->first();

        //Creates a new order if there isn't already an order in place
        if($order == false){

            $orderLine = new OrderLine([
                //'id' => -1,
                'ProductId' => $id,
                'Quantity' => 1,
                'OrderId' => 0
            ]);

            OrderLine::create($orderLine->allDB());
            $orderLine = OrderLine::where('id', $id)->orderByDesc('created_at')->first();

            $order = new Order([
            'id' => 0,
            'OrderDate' => new DateTime(),
            'Status' => 'Basket',
            'OrderLines' => null,
            'CustomerId' => $user->id,
        ]);
            Order::create($order->allDB());
            $order = Order::where('CustomerId', $user->id)->orderByDesc('created_at')->first();
            $orderLine->OrderId = $order->id;
            $order->OrderLines = [$orderLine,];
        }else{
            $order->OrderLines = OrderLine::where('OrderId', $order->id);
            $orderLine = new OrderLine([
                'id' => -1,
                'ProductId' => $id,
                'Quantity' => 1,
                'OrderId' => 0
            ]);
            OrderLine::create($orderLine->allDB());
            $orderLine = OrderLine::where('id', $id)->orderByDesc('created_at')->first();

            array_push($order->OrderLines, $orderLine);
        }

        return Redirect::route('basket.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
