@extends('shared.admin-template')
@section('pageheader', "Edit Appointment")
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

    <form action="{{ route('appointment.edit.post', $appointment->id) }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
            <div class="grid grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="Status" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Status:</label>
                        <select name="Status" id="Status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Select Status</option>
                            @for($x = 0; $x < sizeof($Statuses); $x++)
                                <option <?php if($Statuses[$x] == $appointment->Status){echo "selected";} ?> value="{{$x}}">{{$Statuses[$x]}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="StaffId" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Assigned Staff:</label>
                        <select name="StaffId" id="StaffId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Choose Employee</option>
                            @foreach($staffs as $staff)
                                <option <?php if($staff->id == $appointment->StaffId){echo "selected";} ?> value="{{$staff->id}}">
                                    {{$staff->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <label for="CustomerId" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">Customer's name: {{$CustomerName}}</label>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                        <i class="pt-2 pl-2 fa-solid fa-calendar"></i>
                        <input datepicker type="text" name="DateOf" id="DateOf" value="{{Carbon\Carbon::create($appointment->DateOf)->format('m/d/Y')}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Select Date of Appointment">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Make appointment</button>
    </form>

@endsection
