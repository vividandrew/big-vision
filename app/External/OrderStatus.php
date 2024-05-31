<?php

namespace App\External;

class OrderStatus
{
    //Array containing all the possible statuses the order can be in
    private $status = [
        'Basket',
        'Ordered',
        'payment-processing',
        'Completed',
        'Delivered',
        'Refunded',
        'Cancelled',
    ];

    private $id;

    private function __GetStatusID__(string $name) : int
    {
        //a private function to grab the select id from a string
        switch($name)
        {
            case 'Basket':
                return 0;
            case 'Ordered':
                return 1;
            case 'payment-processing':
                return 2;
            case 'Completed':
                return 3;
            case 'Delivered':
                return 4;
            case 'Refunded':
                return 5;
            case 'Cancelled':
                return 6;
        }
        return -1;
    }

    public function getStatus() : string
    {
        return $this->status[$this->id];
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
        return $this->status;
    }
}


?>
