@extends('shared.template')
@section('pageheader', "Previous Orders")
@section('content')
    <table>
            @if($orders != null)
                @foreach($orders as $order)
                <tr>
                    <td>{{Carbon\Carbon::create($order->OrderDate)->format('m/d/Y')}}</td>
                    <td style="padding-left:20px;">£{{$order->getTotal()}}</td>
                    <td style="padding-left:20px;">{{$order->Status}}</td>
                    <td style="padding-left:20px;"><a href="{{route('order.show', $order->id)}}">View</a></td>
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
