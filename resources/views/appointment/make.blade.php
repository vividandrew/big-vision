@extends('shared.template')
@section('pageheader', "Make Trade-in Appointment")
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

    <form action="{{ route('appointment.create.post') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
            <div class="grid grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <i class="pt-2 pl-2 fa-solid fa-calendar"></i>
                        <input datepicker type="text" name="DateOf" id="DateOf" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Select Date you desire for the appointment">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Make appointment</button>
    </form>

@endsection
