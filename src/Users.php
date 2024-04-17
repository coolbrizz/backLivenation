<?php

namespace App;

class User
{

    public $username;
    public $password;
    public $id;
    public $role;

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Set the value of username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }


    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
}
