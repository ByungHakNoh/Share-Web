<?php

namespace app\data;

class BrandData
{
    private $id;
    private $image;
    private $name;
    private $link;
    private $average_rate;
    private $total_votes;

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getAverageRate()
    {
        return $this->average_rate;
    }

    public function getTotalVotes()
    {
        return $this->total_votes;
    }
}
