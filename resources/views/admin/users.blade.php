@extends('shared.admin-template')
@section('content')
    <p>
        Account View
    </p>
    <table>
        <tr>
            <th>
                User ID
            </th>
            <th>
                Full name
            </th>
            <th>
                Role
            </th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <a href="{{route("user.edit", $user->id)}}"> Edit</a>
                    <a href="{{route("user.destroy", $user->id)}}"> Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
