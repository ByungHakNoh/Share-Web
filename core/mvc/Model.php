<?php

namespace core\mvc;

class Model
{
    protected $returnedData = [];

    public function getReturnedData()
    {
        return $this->returnedData;
    }
}