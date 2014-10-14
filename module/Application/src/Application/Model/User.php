<?php

namespace Application\Model;

class User
{
    public $id;
    public $username;
    public $password;
    public $name;
    public $valid;
    public $role;

//usado pelo TableGateway
    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->username = (!empty($data['username'])) ? $data['username'] : null;
        $this->password = (!empty($data['password'])) ? $data['password'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->valid = (!empty($data['valid'])) ? $data['valid'] : null;
        $this->role = (!empty($data['role'])) ? $data['role'] : null;
    }
}