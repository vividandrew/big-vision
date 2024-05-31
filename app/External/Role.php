<?php

namespace App\External;

class Role
{
    //Array containing all the possible roles a user can be in
    private $roles = [
        'Customer',
        'Warehouse',
        'Store',
        'Manager',
        'Admin'
    ];

    private $id;

    private function __GetRoleID__(string $name) : int
    {
        //a private function to grab the select id from a string
        switch($name)
        {
            case 'Customer':
                return 0;
            case 'Warehouse':
                return 1;
            case 'Store':
                return 2;
            case 'Manager':
                return 3;
            case 'Admin':
                return 4;
        }
        return -1;
    }

    public function getRole() : string
    {
        return $this->roles[$this->id];
    }

    public function setRole(string $role)
    {
        $this->id = $this->__GetRoleID__($role);
    }

    public function setRoleById($id)
    {
        $this->id = $id;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}


?>
