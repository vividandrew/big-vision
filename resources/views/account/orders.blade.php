@extends('shared.template')
@section('pageheader', "Previous Orders")
@section('content')
    <table>
        <tr>
            @if($orders != null)
                @foreach($orders as $order)
                    <td>{{$order->OrderDate}}</td>
                    <td style="padding-left:20px;">{{$order->getTotal()}}</td>
                    <td style="padding-left:20px;">{{$order->Status}}</td>
                @endforeach
            @else
                <td>NO ORDERS MADE</td>
                <td></td>
            @endif
        </tr>
    </table>
@endsection
