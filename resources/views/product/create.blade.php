@extends('shared.admin-template')
@section('pageheader', "Create a Product")
@section('content')
<form action="{{ route('product.create.post') }}" method="POST">
    @csrf
    <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
        <div class="md:pr-20">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Name" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">*Product Name:</label>
                        <input type="text" name="Name" id="Name" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Product Name">
                    </div>
                </div>
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mt-2">
                    <label for="Description" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Product Description</label>
                    <textarea id="Description" name="Description" rows="4" class="block bg-transparent w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
        </div>
        <div class="grid grid-cols-1">
            <div class="grid md:grid-cols-3 md:gap-4 sm:grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Price" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">*Price:</label>
                        <input type="text" name="Price" id="Price" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="1.00">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Stock" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">*Stock:</label>
                        <input type="text" name="Stock" id="Stock" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="0">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Barcode" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Barcode:</label>
                        <input type="text" name="Barcode" id="Barcode" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="03164941">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Platform" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Platform:</label>
                        <input type="text" name="Platform" id="Platform" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Xbox">
                    </div>
                </div>
                <div class="border-gray-900/10">
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <label for="Discount" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Discount:</label>
                            <input type="text" name="Discount" id="Discount" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="0.10">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full border-gray-900/10 pb-3">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="ImageUrl" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Image Url:</label>
                        <input type="text" name="ImageUrl" id="ImageUrl" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="/image/temp.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create New Product</button>

</form>

@endsection
