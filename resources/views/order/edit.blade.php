@extends('shared.admin-template')
@section('pageheader', "Edit Order")
@section('content')
    <form action="{{ route('order.edit.post', $order) }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="id" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Order ID: {{$order->id}}</label>
            </div>
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="Status" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Status:</label>
                <select name="Status" id="Status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 m-2">
                    @for($x = 0; $x < sizeof($Statuses); $x++)
                        <option <?php if($Statuses[$x] == $order->Status){echo "selected";} ?> value="{{$x}}">{{$Statuses[$x]}}</option>
                    @endfor
                </select>
            </div>
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="OrderDate" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Date Ordered: {{$order->OrderDate}}</label>
            </div>
        </div>
        <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Order Status</button>

    </form>
@endsection
