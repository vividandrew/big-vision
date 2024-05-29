@php
    use App\Models\Order;
    use App\Models\OrderLine;
    use App\Models\Product;
 @endphp
    <style>
        td, th{
            padding:5px;
            padding-right:20px;
            border-bottom: 1px solid black;
        }
        .fr{
            border-right: 1px solid black;
        }
    </style>
<h1>Big Vision Games End of Day Report:{{\Carbon\Carbon::today()->format('d/m/y')}}</h1>

<div>
    <div>
        <b>Total made today:</b> £
        <?php
            $todayOrderLines = []; //variable used to display products sold in last section

            //Function grabs total of every order for today
            $total = 0.00;
            foreach(Order::all()->whereBetween('OrderDate', [\Carbon\Carbon::today(),\Carbon\Carbon::tomorrow()]) as $order)
            {
                //This step is required to assign products and orderlines to database which is then
                // calculated at the end to get orders total
                foreach(OrderLine::all()->where('OrderId', $order->id) as $ol)
                {
                    $ol->product = Product::whereId($ol->ProductId)->first();
                    array_push($todayOrderLines, $ol);
                    array_push($order->OrderLines, $ol);
                }
                $total += $order->getTotal();
            }
            echo $total;
            ?>
    </div>
</div>

<div>

    <h3>Products Sold</h3>
    <table>
        <tr>
            <th>
                Product Name
            </th>
            <th>
                Quantity
            </th>
            <th>
                Earned
            </th>
        </tr>
        <?php
            //grouping orderlines
            $sortedOrderLines = [];
            foreach($todayOrderLines as $ol)
            {
                if(key_exists($ol->ProductId, $sortedOrderLines))
                {
                    $sortedOrderLines[$ol->ProductId]->Quantity += $ol->Quantity;
                }else{
                    $sortedOrderLines[$ol->ProductId] = $ol;
                }
            }
            ?>

        @foreach($sortedOrderLines as $ol)
            <tr>
                <td class="fr">
                    {{$ol->product->Name}}
                </td>
                <td>{{$ol->Quantity}}</td>
                <td>£{{$ol->Quantity*$ol->product->Price}}</td>
            </tr>
        @endforeach
    </table>
</div>
