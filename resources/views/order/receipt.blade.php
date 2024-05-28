<!doctype html>
<html lang="en-GB">
<head>
    <style>
        td, th{
            padding:5px;
            padding-right:20px;
            border-bottom: 1px solid black;
        }
        .fr{
            border-right: 1px solid black;
        }
    </style>
</head>
<h1>Big Vision Games Order #{{$order->id}}</h1>

<div>
    <div>
        <b>Total for Order:</b> £{{$order->getTotal()}}
    </div>
    <div>
        <b>Date Ordered:</b> {{$order->OrderDate}}
    </div>
</div>

<div>

    <h3>Products Ordered</h3>
    <table>
        <tr>
            <th>
                Product Name
            </th>
            <th>
                Quantity
            </th>
            <th>
                Cost
            </th>
        </tr>
        @foreach($order->OrderLines as $ol)
            <tr>
                <td class="fr">
                    {{$ol->product->Name}}
                </td>
                <td>{{$ol->Quantity}}</td>
                <td>£{{$ol->Quantity*$ol->product->Price}}</td>
            </tr>
        @endforeach
    </table>
</div>
