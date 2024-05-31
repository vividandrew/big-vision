@extends("shared.template")
@section("pageheader", 'Checkout')
@section("content")
    <form action="{{ route('order.paypal.post', $orderid) }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="total" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Total:{{$total}}</label>
                        </div>
                </div>
        </div>
        <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Connect to paypal account</button>

    </form>
@endsection
