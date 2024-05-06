@extends('shared.template')
@section('pageheader', "Previous Orders")
@section('content')
    <table>
            @if($orders != null)
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->OrderDate}}</td>
                    <td style="padding-left:20px;">£{{$order->getTotal()}}</td>
                    <td style="padding-left:20px;">{{$order->Status}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td>NO ORDERS MADE</td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
    </table>
@endsection
