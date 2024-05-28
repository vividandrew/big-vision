<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Visionary;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class CheckoutController extends Controller
{
    public function Checkout($id)
    {
        $user = Auth::user();
        if($user == null) return redirect('/'); //checks if there is a logged in user

        //makes sure the current logged in user belongs to the order
        if($user->id != Order::whereId($id)->first()->CustomerId){return redirect('/');}
        $order = Order::whereId($id)->first();

        $orderlines = OrderLine::all()->where('OrderId', $id);


        $total = 0.00;

        foreach($orderlines as $ol)
        {
            $product = Product::whereId($ol->ProductId)->first();
            $total += $ol->Quantity * $product->Price;
        }

        return view('basket.checkout')->with('total', $total)->with('order', $order);
    }

    public function CheckoutPost(Request $request, $id)
    {
        //TODO:: to add in valid card and invalid card
        $request->validate([
            'CardNo'=> 'required',
            'ExpDate'=>'required',
            'SecurityNo'=>'required',
            'CardHolderName'=>'required'
        ]);

        $order = Order::whereId($id)->first();
        $order->Status = "payment-processing";
        $order->save();

        if($request['CardNo'] == "4242424242424242")
        {
            //payment is a success
            return redirect('/payment-success');

        }
        //payment was cancelled
        return redirect('/payment-cancelled');


    }
    public function paypal($id)
    {
        $user = Auth::user();
        if($user == null) return redirect('/'); //checks if tehre is a logged in user

        //makes sure the current logged in user belongs to the order
        if($user->id != Order::whereId($id)->first()->CustomerId){return redirect('/');}

        $orderlines = OrderLine::all()->where('OrderId', $id);

        $total = 0.00;

        foreach($orderlines as $ol)
        {
            $product = Product::whereId($ol->ProductId)->first();
            $total += $ol->Quantity * $product->Price;
        }

        return view('basket.paypal')->with('orderid', $id)->with('total', $total);
    }

    public function paypalPost($id)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        // set the order to being processed
        $order = Order::whereId($id)->first();
        $order->Status = "payment-processing";
        $order->save();

        $orderlines = OrderLine::all()->where('OrderId', $id);


        $total = 0.00;

        foreach($orderlines as $ol)
        {
            $product = Product::whereId($ol->ProductId)->first();
            $total += $ol->Quantity * $product->Price;
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($total);
        $amount->setCurrency('GBP');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('/payment-success'))
            ->setCancelUrl(url('/payment-cancelled'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);


        try {
            $payment->create($apiContext);
            return redirect($payment->getApprovalLink());
        } catch (\PayPal\Exception\PayPalConnectionException $e) {
            // Log the detailed error message
            error_log($e->getData());
            return redirect('/payment-error');
        }
    }

    public function paypalIPN($request)
    {

        $listener = new \PayPal\IPN\Listener();
        $listener->useSandbox();
        $listener->setSecret(config('services.paypal.secret'));

        try {
            $verified = $listener->processIpn($request->getContent());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        if ($verified) {
            $transactionId = $request->input('txn_id');
            // Update booking record in database with $transactionId
            // Send confirmation email to customer
            return response()->json(['status' => 'ok'], 200);
        } else {
            return response()->json(['error' => 'Invalid IPN'], 400);
        }
    }

    public function paymentSuccess()
    {
        $user = Auth::user();
        if($user == null) return redirect('/');

        //TODO:: testing to make sure this grabs the correct order
        $order = Order::where('CustomerId', $user->id)->where('Status', 'payment-processing')->first();
        if($order == null) return redirect('/');

        foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
        {
            $ol->product = Product::whereId($ol->ProductId)->first();
            array_push($order->OrderLines, $ol);
        }

        $loyalty  = Visionary::where('CustomerId', Auth::user()->id)->first();
        if($loyalty != null)
        {
            $loyalty->LoyaltyPoints -= $order->PointsSpent;

            $loyalty->LoyaltyPoints += round($order->getTotal());

            $loyalty->save();
        }

        $order->Status = 'Ordered';
        $order->save();

        //TODO:: create receipt for the products the product
        return view('basket.payment-success')->with('id', $order->id);
    }

    public function paymentCancelled()
    {
        $user = Auth::user();
        if($user == null) return redirect('/');

        //TODO:: testing to make sure this grabs the correct order
        $order = Order::where('CustomerId', $user->id)->where('Status', 'payment-processing')->first();
        $order->Status = "Basket";
        $order->save();

        //TODO:: create basic form showing the payment was cancelled
        return view('basket.payment-cancelled');
    }
}
