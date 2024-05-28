@php use Illuminate\Support\Facades\Auth; @endphp
@extends("shared.template")
@section("pageheader", 'Basket')
@section("content")
    <?php $isEmpty = true; ?>
    <?php $loyalty = \App\Models\Visionary::where('CustomerId', Auth::user()->id)->first()?>
    @if($order->OrderLines != null)
        <?php $isEmpty = false; ?>
        @if($loyalty != null)
            @if($loyalty->LoyaltyPoints > 0)
                <h5> Apply loyalty points, from 0 to {{$loyalty->LoyaltyPoints}}</h5>
                <form method="POST" action="{{route('order.applyPoints', $order->id)}}">
                    @csrf
                    <input name="PointsSpent" id="PointsSpent" type="range" min="0" max="{{$loyalty->LoyaltyPoints}}" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Apply points</button>
                </form>
            @endif
        @endif
    @endif
    <table>
        <tr class="border-b-2 border-black">
        @if($isEmpty)
                <td>Your basket is empty, view our products to add to your basket today!</td>
        @else
                <th class="pr-5">
                    Product Name
                </th>
                <th class="pr-5">
                    Quantity
                </th>
                <th class="pr-5">
                    Cost
                </th>
                <th>
                </th>
        @endif
        </tr>
        <?php $total = 0.00;?>
        @if($order->OrderLines != null)
            @foreach($order->OrderLines as $ol)
                <tr>
                    <td class="pr-5 border-r-2 border-black border-b-2">
                        {{$ol->product->Name}}
                    </td>
                    <td class="pr-5 pl-2 border-black border-b-2">{{$ol->Quantity}}</td>
                    <td class="pr-5 border-black border-b-2">£{{$ol->Quantity*$ol->product->Price}}</td>
                    <?php $total += $ol->Quantity*$ol->product->Price;?>
                    <td>
                        <a class="p-1 bg-gray-300 hover:bg-gray-400 rounded" href="{{route('order.removeProduct', $ol->id)}}">Remove item</a>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    @if(!$isEmpty)
    <?php
        echo "Visionary points Applied: ".$order->PointsSpent;
        if($order->PointsSpent != null)
        {
            $total = $total - ($order->PointsSpent * 0.1);
        }

        //This is in place so that the order doesn't go into negatives
        if($total < 0)
        {
            $pointRefund = 0;

            //loop to check the number of points it takes to get total back to 0
            while($total < 0)
            {
                $total += 0.1;
                $pointRefund++;
            }
            $order->PointsSpent -= $pointRefund;
        }
    ?>
        <h5>Total: £{{$total}}</h5>
        <div class="p-2">
            <a class="bg-gray-300 hover:bg-gray-400 rounded p-2" href="{{route('order.checkout', $order->id)}}">Order</a>
        </div>
    @endif
@endsection
