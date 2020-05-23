<?php

namespace app\data;

class UserInfo
{
    private $user_id;
    private $password;
    private $nick_name;
    private $sex;
    private $admin;
    private $donation_money;

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

    public function getIsAdmin()
    {
        return $this->admin;
    }

    public function getDonationMoney()
    {
        return $this->donation_money;
    }
}
