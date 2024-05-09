@php use Illuminate\Support\Facades\Auth; @endphp
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
                    @if(\App\Models\Visionary::where('CustomerId', Auth::user()->id)->first() == null)
                    <form id="registerLoyalty" method="POST" action="{{route('user.register.loyalty')}}" >
                        @csrf
                        <a onclick="event.preventDefault();document.getElementById('registerLoyalty').submit()" href="{{route('user.register.loyalty')}}">Register to become a visionary!</a>
                    </form>
                    @endif
                </p>

            </div>
        </div>
    </div>
@endsection
