@extends("shared.template")
@section("pageheader", 'Checkout')
@section("content")
        <form action="{{ route('order.checkout.post', $order->id) }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3"><div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="CardNo" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Card Number:</label>
                        <input type="text" name="CardNo" id="CardNo" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="16 Digit Number on the card">
                    </div>
                </div>
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                    <label for="ExpDate" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Expiration Date</label>
                    <input type="text" name="ExpDate" id="ExpDate" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Experation Date">
                </div>
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                    <label for="SecurityNo" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Security Code</label>
                    <input type="text" name="SecurityNo" id="SecurityNo" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="last 3 Digits of a 6 digit number on the card">
                </div>
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                    <label for="CardHolderName" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Cardholder Name</label>
                    <input type="text" name="CardHolderName" id="CardHolderName" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Name of Card as Displayed">
                </div>
            </div>
            <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Make Card Payment</button>

        </form>
    <h3>Total: £{{$total}}</h3>
    <a href="{{route('order.paypal', $order->id)}}" method="POST"><i class="fa-brands fa-cc-paypal"></i> Pay with Paypal</a>
@endsection
