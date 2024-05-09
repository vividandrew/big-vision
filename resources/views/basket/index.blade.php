@php use Illuminate\Support\Facades\Auth; @endphp
@extends("shared.template")
@section("pageheader", 'Basket')
@section("content")
    <?php $loyalty = \App\Models\Visionary::where('CustomerId', Auth::user()->id)->first()?>
    @if($loyalty != null)
        @if($loyalty->LoyaltyPoints > 0)
            <form method="POST" action="{{route('order.applyPoints', $order->id)}}">
                @csrf
                <label for="PointsSpent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min-max range</label>
                <input name="PointsSpent" id="PointsSpent" type="range" min="0" max="{{$loyalty->LoyaltyPoints}}" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Apply points</button>
            </form>
        @endif
    @endif
    <table>
        <tr>
            <td>This is a table for baskets!</td>
            <td>{{$order->id}}</td>
            <?php $total = 0.00;?>
        </tr>
        @if($order->OrderLines != null)
            @foreach($order->OrderLines as $ol)
                <tr>
                    <td>
                        {{$ol->product->Name}}
                    </td>
                    <td>{{$ol->Quantity}}</td>
                    <td>{{$ol->Quantity*$ol->product->Price}}</td>
                    <?php $total += $ol->Quantity*$ol->product->Price;?>
                </tr>
            @endforeach
        @endif
    </table>
    <?php
        echo "Visionary points Applied: ".$order->PointsSpent;
        if($order->PointsSpent != null)
        {
            $total = $total - ($order->PointsSpent * 0.1);
        }
    ?>
    <h5>Total: {{$total}}</h5>
    <a href="{{route('order.checkout', $order->id)}}">Order</a>
@endsection
