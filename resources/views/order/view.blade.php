@extends('shared.template')
@section('pageheader', "Order")
@section('content')
    <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
            Status: {{$order->Status}}
        </div>
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
            Total for Order: {{$order->getTotal()}}
        </div>
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
            Date Ordered: {{$order->OrderDate}}
        </div>
    </div>
    <h5>Products Ordered</h5>
    <table>
        @foreach($order->OrderLines as $ol)
            <tr>
                <td>{{$ol->product->Name}}</td>
                <td>{{$ol->Quantity}}</td>
                <td>{{$ol->Quantity*$ol->product->Price}}</td>
            </tr>
        @endforeach
    </table>
@endsection
