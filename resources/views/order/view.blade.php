@extends('shared.template')
@section('pageheader', "Order")
@section('content')
    <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
            Status: {{$order->Status}}
        </div>
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
            Total for Order: £{{$order->getTotal()}}
        </div>
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
            Date Ordered: {{$order->OrderDate}}
        </div>
    </div>

    <h5>Products Ordered</h5>
    <table>
        <tr class="border-b-2 border-black">
                <th class="pr-5">
                    Product Name
                </th>
                <th class="pr-5">
                    Quantity
                </th>
                <th class="pr-5">
                    Cost
                </th>
        </tr>
            @foreach($order->OrderLines as $ol)
                <tr>
                    <td class="pr-5 border-r-2 border-black border-b-2">
                        {{$ol->product->Name}}
                    </td>
                    <td class="pr-5 pl-2 border-black border-b-2">{{$ol->Quantity}}</td>
                    <td class="pr-5 border-black border-b-2">£{{$ol->Quantity*$ol->product->Price}}</td>
                </tr>
            @endforeach
    </table>
    <div class="pt-5 pb-10">
        <a class="bg-blue-300 hover:bg-blue-400 rounded p-2" href="{{route('download.receipt', $order->id)}}">Download Receipt</a>
    </div>
@endsection
