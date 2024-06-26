@extends("shared.template")
@section("pageheader", 'Checkout')
@section("content")
        <form action="{{ route('order.checkout.post', $order->id) }}" method="POST">
            @csrf
            <?php $user = Auth::user(); ?>
            <h5>Delivery Address</h5>

                <div class="grid grid-cols-2 pb-10">
                        <div class="m-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <label for="AddressLine1" class="flex bg-white font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">AddressLine1:</label>
                                <input type="text" required name="AddressLine1" value="{{$user->AddressLine1}}" id="Price" class="block flex-1 border-0  py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="AddressLine1">
                            </div>
                        </div>
                        <div class="m-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <label for="AddressLine2" class="flex bg-white font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">AddressLine2:</label>
                                <input type="text" name="AddressLine2" value="{{$user->AddressLine2}}" id="Price" class="block flex-1 border-0 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="AddressLine2">
                            </div>
                        </div>
                        <div class="m-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <label for="Town" class="flex bg-white font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Town:</label>
                                <input type="text" required name="Town" value="{{$user->Town}}" id="Stock" class="block flex-1 border-0 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Town">
                            </div>
                        </div>
                        <div class="m-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                <label for="PostCode" class="flex bg-white font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">PostCode:</label>
                                <input type="text" required name="PostCode" value="{{$user->PostCode}}" id="Barcode" class="block flex-1 border-0 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="PostCode">
                            </div>
                        </div>
                </div>
            <h5>Card Details</h5>
            <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
                <div class="mt-2">
                    <div class="flex m-2 rounded-md bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="CardNo" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Card Number:</label>
                        <input type="text" name="CardNo" id="CardNo" class="block invalid:border-pink-400 invalid:text-red-600 flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" required minlength="16" maxlength="16" placeholder="16 Digit Number on the card">
                    </div>
                </div>
                <div class="flex m-2 rounded-md bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <label for="ExpDate" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Expiration Date</label>
                    <input type="text" required pattern="[0-9][0-9]/[0-9][0-9]" minlength="5" maxlength="5" name="ExpDate" id="ExpDate" class="block invalid:border-pink-400 invalid:text-red-600 flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Experation Date">
                </div>
                <div class="flex m-2 rounded-md bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                    <label for="SecurityNo" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Security Code</label>
                    <input type="text" minlength="3" maxlength="3" name="SecurityNo" pattern="[0-9][0-9][0-9]" id="SecurityNo" class="block flex-1 invalid:border-pink-400 invalid:text-red-600 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="last 3 Digits of a 6 digit number on the card">
                </div>
                <div class="flex m-2 rounded-md bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                    <label for="CardHolderName" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Cardholder Name</label>
                    <input type="text" name="CardHolderName" id="CardHolderName" class="block flex-1 border-0 bg-transparent invalid:border-pink-400 invalid:text-red-600 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Name of Card as Displayed">
                </div>
            </div>
            <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Make Card Payment</button>

        </form>
        <?php $total = $total - ($order->PointsSpent * 0.1) ?>
    <h3>Total: £{{$total}}</h3>
        <?php $user = Auth::user(); ?>
        @if(
            $user->AddressLine1 == null ||
        $user->Town == null ||
        $user->PostCode == null)
            <p>you can use paypal as a method, but in order to use that you must update your address! please follow the current link to edit your profile <a class="text-blue-600 hover:text-blue-400" href="{{route('profile.edit')}}">here</a></p>
        @else
            <a href="{{route('order.paypal', $order->id)}}" method="POST"><i class="fa-brands fa-cc-paypal"></i> Pay with Paypal</a>
        @endif
@endsection
