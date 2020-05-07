<?php

namespace app\data;

class UserInfo
{
    private $user_id;
    private $password;
    private $nick_name;
    private $sex;

    public function getUserID()
    {
        return $this->user_id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNickName()
    {
        return $this->nick_name;
    }

    public function getSex()
    {
        return $this->sex;
    }
}
