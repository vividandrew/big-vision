@extends('shared.admin-template')
@section('content')
    <p>
        Orders View
    </p>
    <table>
        <tr>
            <th>
                Order ID
            </th>
            <th>
                Status
            </th>
            <th>
                Price
            </th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->Status}}</td>
                <td>{{$order->getTotal()}}</td>
                <td>
                    <a href="{{route("order.edit", $order->id)}}"> Edit</a>
                    <a href="{{route("order.destroy", $order->id)}}"> Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
