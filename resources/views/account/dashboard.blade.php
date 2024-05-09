@extends('shared.template')
@section('pageheader', "Dashboard")
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div>
                <p>
                    <a href="{{route('account.orders')}}">View Orders</a>
                    <a href="{{route('appointment.create')}}">Make Trade in Appointment</a>
                </p>

            </div>
        </div>
    </div>
@endsection
