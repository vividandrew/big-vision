<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AppointmentController extends Controller
{
    //TODO:: Make views for all appointment classes
    public function index()
    {
        $appointments = Appointment::all()->where('CustomerId', Auth::user()->id);
        return view('appointment.index')->with('appointments', $appointments);
    }

    public function create()
    {
        return view('appointment.create');
    }

    public function createPost(Request $request)
    {
        //TODO:: Create function to check if its staff making appointment or user
        $user = Auth::user();
        if($user == null) return redirect()->route('home.index');

        $request->validate([
            'DateOf'=>'required',
        ]);

        $appointment = new Appointment([
            "DateOf" => $request['DateOf'],
            "Status" => "Requested",
            "CustomerId" => $user->id,
            "StaffId" => "-1"
        ]);

        Appointment::create($appointment->allDB());
        return redirect()->route('home.index');
    }

    public function edit($id)
    {
        $appointment = Appointment::whereId($id)->first();
        return view('appointment.edit')->with('appointment', $appointment);
    }

    public function editPost(Request $request, $id)
    {
        $appointment = Appointment::whereId($id)->first();
        $request->validate([
                'Status'=>'required',
            'DateOf'=>'required',
            'StaffId' => 'required',
        ]);

        //Checks if any changes are made
        $changes = false;
        if($appointment->Status != $request['Status']) {$appointment->Status = $request['Status']; $changes = true;}
        if($appointment->DateOf != $request['DateOf']) {$appointment->DateOf = $request['DateOf']; $changes = true;}
        if($appointment->StaffId != $request['StaffId']) {$appointment->StaffId = $request['StaffId']; $changes = true;}

        //if a change was made save to database
        if($changes) $appointment->save();
        return redirect()->route('admin.index');
    }
}
