<?php

namespace app\data;

class AdminData
{

    private $id;
    private $country;
    private $browser;
    private $time_stamp;

    public function getID()
    {
        return $this->id;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getBrowser()
    {
        return $this->browser;
    }

    public function getTimeStamp()
    {
        return $this->time_stamp;
    }
}
