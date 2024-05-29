@extends('shared.template')
@section('pageheader', "Products")
@section('content')
    <div class="grid grid-cols-2">
        <div>
            <h3>
                {{$product->Name}}
            </h3>
            <p>
                {{$product->Price}}
            </p>
            <div class="m-2">
                <form id="userLogout" method="POST" action="{{ route('order.product', $product->id) }}">
                    @csrf
                    <div class="grid grid-cols-1">
                        <div class="mb-5" >
                            <input type="number" min="0" name="Quantity" id="Quantity" class="bg-gray-50 invalid:border-pink-400 invalid:text-red-600 border border-gray-300 w-20 text-gray-900 block text-sm rounded-lg p-2.5" placeholder="1" value="1" required />
                        </div>
                        <div>
                            <button type="submit" class="bg-gray-300 p-2 hover:bg-gray-400">Add item to basket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            {{$product->Description}}
        </div>
    </div>
@endsection
