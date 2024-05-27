@extends('shared.admin-template')
@section('pageheader', "Edit User")
@section('content')
    <form action="{{ route('user.edit.post', $user->id) }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 sm:grid-cols-1 pb-3">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="id" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">User's ID: {{$user->id}}</label>
            </div>
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="Name" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">User's Name: {{$user->name}}</label>
            </div>
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                <label for="role" class="flex font-bold select-none items-center pl-3 text-gray-500 sm:text-sm">User's role:</label>
                <select name="role" id="role" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900">
                    @for($x = 0; $x < sizeof($Roles); $x++)
                        <option <?php if($Roles[$x] == $user->role){echo "selected";} ?> value="{{$x}}">{{$Roles[$x]}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <button type="submit" class="h-20 w-full md:h-10 md:w-fit rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Order Status</button>

    </form>
@endsection
