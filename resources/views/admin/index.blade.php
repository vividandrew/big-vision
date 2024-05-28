@extends('shared.admin-template')
@section('pageheader', "Home")
@section('content')
    <p>
        Admin page
    </p>
    <div class="grid grid-cols-2">
        <div class="bg-gray-400 rounded fixed p-5">
            @include('admin.EOD')
            <a class="text-blue-300 hover:text-blue-400" href="{{route('admin.print.eod')}}">Print EOD</a>
        </div>
    </div>


@endsection
