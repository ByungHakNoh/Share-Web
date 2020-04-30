<?php

namespace app\data;

class UserInfo
{

    private $userID;
    private $password;

    public function getUserID()
    {
        return $this->userID;
    }

    public function getPassword()
    {
        return $this->password;
    }
}