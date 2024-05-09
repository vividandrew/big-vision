@extends('shared.admin-template')
@section('pageheader', "Appointments")
@section('content')
    <table>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Date Of</th>
            <th>Customer Name</th>
            <th>Assigned Staff</th>
            <th>Controls</th>
        </tr>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{$appointment->id}}</td>
                <td>{{$appointment->Status}}</td>
                <td>{{$appointment->DateOf}}</td>
                <td>{{$appointment->CustomerName}}</td>
                <td>{{$appointment->StaffName}}</td>
                <td>
                    <a href="{{route('appointment.edit', $appointment->id)}}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
