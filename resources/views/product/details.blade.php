@extends('shared.template')
@section('pageheader', "Products")
@section('content')

    <p>
        {{$product->Name}}
    </p>
    <p>
        <a href="{{route('order.product', $product->id)}}">Add to Basket</a>
    </p>
@endsection
