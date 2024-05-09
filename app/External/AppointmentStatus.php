<?php

namespace App\External;

class AppointmentStatus
{
    private $statuses = [
        'Requested',
        'Appointed',
        'Completed'
    ];

    private $id;

    private function __GetStatusID__(string $name) : int
    {
        switch($name)
        {
            case 'Requested':
                return 0;
            case 'Appointed':
                return 1;
            case 'Completed':
                return 2;
        }
        return -1;
    }

    public function getStatus() : string
    {
        return $this->statuses[$this->id];
    }

    public function setStatus(string $status)
    {
        $this->id = $this->__GetStatusID__($status);
    }

    public function setStatusById($id)
    {
        $this->id = $id;
    }

    public function getStatuses()
    {
        return $this->statuses;
    }
}


?>
