<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\External\AppointmentStatus;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        //Goes through each appointment and assigning the correct information to the appointment class
        //used for the display view
        foreach($appointments as $appointment)
        {
            $appointment->CustomerName = User::whereId($appointment->CustomerId)->first()->name;

            //Quick function for a simple if tstatement checking if there is an assigned staff member
            $appointment->StaffId <= 0 ? $appointment->StaffName = "To Be Assigned" :
                $appointment->StaffName = User::whereId($appointment->StaffId)->first()->name;
        }

        return view('appointment.index')->with('appointments', $appointments);
    }

    public function show($id)
    {
        $appointment = Appointment::whereId($id)->first();
        return view('appointment.show')->with('appointment',$appointment);
    }

    public function create()
    {
        return view('appointment.create');
    }

    public function createPost(Request $request)
    {
        $user = Auth::user();

        //A check to ensure there is a logged in user
        if($user == null) return redirect()->route('home.index');

        $request->validate([
            'DateOf'=>'required',
        ]);

        $appointment = new Appointment([
            "DateOf" => Carbon::createFromFormat('m/d/Y', $request['DateOf']),
            "Status" => "Requested",
            "CustomerId" => $user->id,
            "StaffId" => 0
        ]);

        //Saves appointemnt to the database
        Appointment::create($appointment->allDB());
        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $appointment = Appointment::whereId($id)->first();

        //A list to display for the selection box
        $staffs = User::all()->whereNotIn('role', 'Customer');
        $customer = User::whereId($appointment->CustomerId)->first();

        //returns to view with variables the view can use to display the correct information
        return view('appointment.edit')
            ->with('appointment', $appointment)
            ->with('staffs',$staffs)
            ->with('CustomerName', $customer->name)
            ->with('Statuses', (new AppointmentStatus)->getStatuses());
    }

    public function editPost(Request $request, $id)
    {
        $appointment = Appointment::whereId($id)->first(); //grabs the first appointment with the assigned id

        //Validates the input made to the form
        $request->validate([
            'Status' => 'required',
            'StaffId' => 'required',
            'DateOf' => 'required'
        ]);

        //Checks if any changes are made
        $changes = false;
        $Status = new AppointmentStatus();
        $Status->setStatusById($request['Status']);

        //Checks to see if changes have been made
        if($appointment->Status != $Status->getStatus()) {$appointment->Status =      $Status->getStatus(); $changes = true;}
        if($appointment->DateOf != Carbon::createFromFormat('m/d/Y', $request['DateOf'])) {$appointment->DateOf =      Carbon::createFromFormat('m/d/Y', $request['DateOf']); $changes = true;}
        if($appointment->StaffId != $request['StaffId']) {$appointment->StaffId =   $request['StaffId']; $changes = true;}

        //if a change was made save to database
        if($changes) $appointment->save();
        return redirect()->route('admin.index');
    }

}
