<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
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
        $user = Auth::user(); //Grabs the user from the authenticator controller

        //If there is no logged in user return the user to the homepage
        if($user == null){ return redirect('/');}

        //grabs all the orders for the user
        //TODO::PAGINATE THIS
        $orders = Order::all()->where('CustomerId', $user->id)
            ->whereNotIn('Status', 'Basket') //Where not a basket order
            ->sortBy('OrderDate');
        if($orders != null)
        {
            foreach($orders as $order)
            {
                foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
                {
                    $ol->product = Product::whereId($ol->ProductId)->first(); //For Display purposes only, sets product to the OL class
                    array_push($order->OrderLines, $ol); //Pushes the orderline onto the array on the Order class
                }
            }
        }


        return view('account.orders')->with('orders', $orders);
    }

    /**
     *  For development of the actual receipt to enable to route in web.php
     */
    public function PrintReceipt($id)
    {
        $order = Order::whereId($id)->first();
        foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
        {
            $ol->product = Product::whereId($ol->ProductId)->first();
            array_push($order->OrderLines, $ol);
        }
        return view('order.receipt')->with('order', $order);
    }


    /**
     *  Render the receipt as a pdf that the user can download
     */
    public function downloadReceipt($id)
    {
        $order = Order::whereId($id)->first();
        foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
        {
            $ol->product = Product::whereId($ol->ProductId)->first();
            array_push($order->OrderLines, $ol);
        }

        $pdf = new Dompdf();
        $pdf->loadHtml(view('order.receipt')->with('order', $order));
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream();
    }
    /*
     *  Basket
     */
    public function basket()
    {
        $user = Auth::user(); //Grabs the user from the authenticator controller

        //If there is no logged in user return the user to the homepage
        if($user == null){ return redirect('/');}

        //Grabs the most recent order for the user
        //This creates a new one to be used as a base basket for whenever the user returns
        $order = Order::where('CustomerId', $user->id)->where('Status', 'Basket')->first();

        //Creates a new order if there isn't already an order in place
        if($order == null){ $order = new Order([
            'id' => 0,
            'OrderDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'Status' => 'Basket',
            'OrderLines' => [],
            'CustomerId' => $user->id,
            'PointsSpent' => 0
        ]);
            Order::create($order->allDB());
            $order = Order::where('CustomerId', $user->id)->where('Status', 'Basket')->first();

        }else{
            //grabs all orderlines where the OrderId matches
            foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
            {
                $ol->product = Product::whereId($ol->ProductId)->first(); //For Display purposes only, sets product to the OL class
                array_push($order->OrderLines, $ol); //Pushes the orderline onto the array on the Order class
            }
        }

        //return $order->OrderLines; //Testing to view orderlines array

        return view('basket.index')->with('order', $order);
    }

    /*
     * Add Product to order
     */
    public function addProduct(Request $request ,$id)
    {
        $request->validate([
            'Quantity'=> 'required',
        ]);
        $quantity = (int)$request['Quantity'];

        $user = Auth::user();
        if($user == null) return redirect('/register');

        $product = Product::whereId($id)->first();
        if($product == null) return redirect('/products');

        if($product->Stock < $quantity) return redirect('/products');

        //Grabs the most recent order(basket) for the user
        $order = Order::where('CustomerId', $user->id)->orderByDesc('created_at')->first();

        //Creates a new order if there isn't already an order in place
        if($order == null){
            $order = new Order([
                'id' => 0,
                'OrderDate' => Carbon::now()->format('Y-m-d H:i:s'),
                'Status' => 'Basket',
                'OrderLines' => [],
                'CustomerId' => $user->id,
                'PointsSpent' => 0,
            ]);
            Order::create($order->allDB()); //this creates a database entry, but in this case is used to set ID
            $order = Order::where('CustomerId', $user->id)->orderByDesc('created_at')->first(); //resets order to have correct id

            //Creates a new orderline that the product will be assosiated with
            $orderLine = new OrderLine([
                'id' => -1,
                'ProductId' => $id,
                'Quantity' => $quantity,
                'OrderId' => $order->id,
            ]);

            OrderLine::create($orderLine->allDB()); //same as the order this creates an Orderlines for the purposes of having the correct ID
            $orderLine = OrderLine::where('id', $id)->orderByDesc('created_at')->first(); //resets orderline with the correct ID

            $order->OrderLines = [$orderLine,]; //Creates a new orderlines with the first line
        }else{
            //This is executed if the order exists

            //This grabs all orderlines for the current order
            foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
            {
                $ol->product = Product::whereId($ol->ProductId)->first();
                array_push($order->OrderLines, $ol);
            }

            $exist = false; //Variable to store if product already exists in orderlines
            foreach($order->OrderLines as $ol)
            {
                if($ol->ProductId == $id)
                {
                    $exist = true;
                    //TODO:: check quantity number
                    $ol->Quantity += $quantity;
                    $ol->update(); //Updates the database
                    break;
                }
            }

            //The product didn't exist already
            if(!$exist)
            {
                $orderLine = new OrderLine([
                    'id' => -1,
                    'ProductId' => $id,
                    'Quantity' => $quantity,
                    'OrderId' => $order->id
                ]);

                //TODO:: check if the following is actually needed
                OrderLine::create($orderLine->allDB()); //adds orderline to the database
                //$orderLine = OrderLine::where('OrderId', $order->id)->orderByDesc('created_at')->first(); //reassigns for id
                array_push($order->OrderLines, $orderLine);
            }
        }

        $product->Stock-= $quantity;
        $product->save();

        return redirect('/basket'); //Order page is used to add product, redirects user to basket after order is filled
    }

    /*
     *  Remove product from order
     */
    public function removeProduct($id)
    {
        $orderLine = OrderLine::whereId($id)->first();

        $product = Product::whereId($orderLine->ProductId)->first();
        $product->Stock += $orderLine->Quantity; //Adds the quantity back to existing stock

        //Final update of the product
        $orderLine->delete();
        $product->save();
        return redirect()->route('account.basket');
    }

    /**
     * Create order status
     */

    public function createOrder($id)
    {
        //Checks if order exists
        $order = Order::whereId($id)->first();
        if($order == null) return redirect('/');

        //Checks if the user is a logged in user
        $user = Auth::user();
        if($user == null) return redirect('/');

        //Final check to make sure the order being made belongs to the currently logged in user
        if($user->id != $order->CustomerId) return  redirect('/');

        $order->status = "Ordered";

        $order->update(); //Update database

        $order = new Order([
            'id' => 0,
            'OrderDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'Status' => 'Basket',
            'OrderLines' => [],
            'CustomerId' => $user->id,
            'PointsSpent' => 0,
        ]);
        Order::create($order->allDB());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::whereId($id)->first();

        foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
        {
            $ol->product = Product::whereId($ol->ProductId)->first();
            array_push($order->OrderLines, $ol);
        }
        return view('order.view')->with("order", $order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::whereId($id)->first();
        return view('order.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'Status' => 'required',
        ]);

        $order = Order::whereId($id)->first();
        if($order->Status != $request['Status'])
        {
            $order->Status = $request['Status'];
            $order->save();
        }

        return redirect()->route('admin.orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function applyPoints(Request $request, $id)
    {
        $order = Order::whereId($id)->first();
        $order->PointsSpent = $request['PointsSpent'];
        $order->save();

        return redirect()->route('account.basket');
    }
}
