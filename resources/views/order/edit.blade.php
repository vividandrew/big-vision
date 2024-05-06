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
                <label for="Status" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Order Status:</label>
                <input type="text" name="Status" id="Status" value="{{$order->Status}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Refund">
            </div>
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="OrderDate" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Date Ordered: {{$order->OrderDate}}</label>
            </div>
        </div>
        <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Order Status</button>

    </form>
@endsection
