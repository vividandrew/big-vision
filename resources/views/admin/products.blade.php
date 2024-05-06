@extends('shared.admin-template')
@section('content')
    <p>
        Product View
    </p>
    <h5><a href="{{route('product.create')}}">Create a new product</a></h5>
    <table>
        <tr>
            <th>
                Product ID
            </th>
            <th>
                Product Name
            </th>
            <th>
                Price
            </th>
            <th>
                Barcode
            </th>
            <th>
                Stock
            </th>
            <th>
                Control Links
            </th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->Name}}</td>
                <td>{{$product->Price}}</td>
                <td>{{$product->Barcode}}</td>
                <td>{{$product->Stock}}</td>
                <td>
                    <a href="{{route("product.edit", $product->id)}}"> Edit</a>
                    <a href="{{route("product.destroy", $product->id)}}"> Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
