@extends("shared.template")
@section("pageheader", 'Basket')
@section("content")
    <table>
        <tr>
            <td>This is a table for baskets!</td>
            <td>{{$order->id}}</td>
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
                </tr>
            @endforeach
        @endif
    </table>
    <a href="{{route('order.basket', $order->id)}}">Order</a>
@endsection
