@extends("shared.template")
@section("pageheader", 'Basket')
@section("content")
    <table>
        <tr>
            <td>This is a table for baskets!</td>
            <td>{{$order->id}}</td>
            <?php $total = 0.00;?>
        </tr>
        @if($order->OrderLines != null)
            @foreach($order->OrderLines as $ol)
                <tr>
                    <td>{{$ol->ProductId}}</td>
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
    <h5>Total: {{$total}}</h5>
    <a href="{{route('order.checkout', $order->id)}}">Order</a>
@endsection
