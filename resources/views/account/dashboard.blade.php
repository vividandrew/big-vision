@php use Illuminate\Support\Facades\Auth; @endphp
@extends('shared.template')
@section('pageheader', "Dashboard")
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome {{Auth::user()->name}}, to your dashboard
                </div>
            </div>
            <div class="grid grid-cols-3">
                <div class="bg-gray-300 rounded-lg p-2 m-2">
                    <a href="{{route('account.orders')}}">View Orders</a>
                </div>
                <div class="bg-gray-300 rounded-lg p-2 m-2">
                    @if(\App\Models\Appointment::where('CustomerId', Auth::user()->id)->first() == null)
                        <a href="{{route('appointment.create')}}">Make Trade in Appointment</a>
                    @else
                        @php
                            $app = \App\Models\Appointment::where('CustomerId', Auth::user()->id)->orderByDesc('DateOf')->first();
                            $message = "";

                            switch($app->Status)
                            {
                                case "Requested":
                                    $message = "Appointment to be assigned to staff";
                                    break;
                                case "Appointed":
                                    $message = "Your appointment has been allocated to:<br>"
                                    . $app->DateOf
                                    . "<br> Your registered to have an appointment with "
                                    . App\Models\User::whereId($app->StaffId)->first()->name;
                                    break;
                                default:
                                    @endphp <a href="{{route('appointment.create')}}">Make Trade in Appointment</a>@php
                            }

                            echo $message;
                        @endphp
                    @endif
                </div>
                <div class="bg-gray-300 rounded-lg p-2 m-2">
                    @if(\App\Models\Visionary::where('CustomerId', Auth::user()->id)->first() == null)
                        <form id="registerLoyalty" method="POST" action="{{route('user.register.loyalty')}}" >
                            @csrf
                            <a onclick="event.preventDefault();document.getElementById('registerLoyalty').submit()" href="{{route('user.register.loyalty')}}">Register to become a visionary!</a>
                        </form>
                    @else
                        Current Visionary Points: {{\App\Models\Visionary::where('CustomerId', Auth::user()->id)->first()->LoyaltyPoints}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
