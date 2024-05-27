@extends('shared.template')
@section('pageheader', "Update a Product")
@section('content')
<form method="POST" action="{{route('profile.edit.post')}}" class="mt-6 space-y-6">

    @csrf
    <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
        <div class="md:pr-20">
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <label for="name" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Name:</label>
                    <input type="text" name="name" id="name" value="{{old('name', $user->name)}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="David">
                </div>
            </div>
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                <label for="AddressLine1" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">AddressLine1</label>
                <textarea id="AddressLine1" name="AddressLine1" rows="4" class="block bg-transparent w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{old('AddressLine1', $user->AddressLine1)}}</textarea>
            </div>
        </div>
        <div class="grid grid-cols-1">
            <div class="grid md:grid-cols-3 md:gap-4 sm:grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="AddressLine2" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">AddressLine2:</label>
                        <input type="text" name="AddressLine2" value="{{old('AddressLine2', $user->AddressLine2)}}" id="Price" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="AddressLine2">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Town" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Town:</label>
                        <input type="text" name="Town" value="{{old('Town', $user->Town)}}" id="Stock" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Town">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="PostCode" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">PostCode:</label>
                        <input type="text" name="PostCode" value="{{old('PostCode', $user->PostCode)}}" id="Barcode" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="PostCode">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Product</button>

</form>
@endsection
