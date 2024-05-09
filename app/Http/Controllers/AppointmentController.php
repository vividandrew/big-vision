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
    //TODO:: Make views for all appointment classes
    public function index()
    {
        //TODO:: if staff is not admin, select only appointments assigned to the staff
        $appointments = Appointment::all();//->where('Status', 'Requested')->orWhere('Status', 'Appointed');

        foreach($appointments as $appointment)
        {
            $appointment->CustomerName = User::whereId($appointment->CustomerId)->first()->name;

            $appointment->StaffId == 0 ? $appointment->StaffName = "To Be Assigned" :
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
        //TODO:: Create function to check if its staff making appointment or user
        $user = Auth::user();
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

        Appointment::create($appointment->allDB());
        return redirect()->route('home.index');
    }

    public function edit($id)
    {
        $appointment = Appointment::whereId($id)->first();
        $staffs = User::all()->whereNotIn('role', 'Customer');
        $customer = User::whereId($appointment->CustomerId)->first();
        return view('appointment.edit')
            ->with('appointment', $appointment)
            ->with('staffs',$staffs)
            ->with('CustomerName', $customer->name)
            ->with('Statuses', (new AppointmentStatus)->getStatuses());
    }

    public function editPost(Request $request, $id)
    {
        $appointment = Appointment::whereId($id)->first();

        $request->validate([
            'Status' => 'required',
            'StaffId' => 'required',
            'DateOf' => 'required'
        ]);

        //Checks if any changes are made
        $changes = false;
        $Status = new AppointmentStatus();
        $Status->setStatusById($request['Status']);

        if($appointment->Status != $Status->getStatus()) {$appointment->Status =      $Status->getStatus(); $changes = true;}
        if($appointment->DateOf != Carbon::createFromFormat('m/d/Y', $request['DateOf'])) {$appointment->DateOf =      Carbon::createFromFormat('m/d/Y', $request['DateOf']); $changes = true;}
        if($appointment->StaffId != $request['StaffId']) {$appointment->StaffId =   $request['StaffId']; $changes = true;}

        //if a change was made save to database
        if($changes) $appointment->save();
        return redirect()->route('admin.index');
    }

}
