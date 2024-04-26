@extends("shared.template")
@section("pageheader", 'Basket')
@section("content")
    <table>
        <tr>
            <td>This is a table for baskets!</td>
            <td>{{$order->id}}</td>

        </tr>
    </table>
@endsection
