<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends User
{
    // ===================================
    //        CLASS VARIABLES
    //=====================================
    /**
     * @var array<String, Appointment>
     */
    private array $Appointments;
    // ===================================
    //        GETTERS AND SETTERS
    //=====================================
    /**
     * @return Appointment[]
     */
    public function getAppointments(): array
    {
        return $this->Appointments;
    }

    /**
     * @param Appointment[] $Appointments
     */
    public function setAppointments(array $Appointments): void
    {
        $this->Appointments = $Appointments;
    }


    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes = [
        //'id' => "-1",
        'FullName' => "Andrew Warnock",
        'Email' => "30407681@bigvisiongames.co.uk",
        'ContactNo' => "01411231231234",
        'Password' => "123",
        'Role' => "Test",
        'Appointments' => [new Appointment()]
    ])
    {
        parent::__construct($attributes);
        $this->Appointments = $attributes['Appointments'];
    }

}
