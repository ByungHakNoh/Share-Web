<?php

namespace app\models;

use core\App;

require 'app/data/BoardReadData.php';

class BoardReadModel
{
    private $returnedData = [];

    public function fetchBoardData($requestPostID)
    {
        $tableName = 'free_board';
        $dataClass = 'app\data\BoardReadData';
        $postElements = App::get('database')->fetchValueByID($tableName, $requestPostID, $dataClass);

        $addedHitCount = $postElements[0]->getHit() + 1;

        App::get('database')->updateData($tableName, $requestPostID, ['hit' =>  $addedHitCount]);

        $this->returnedData = ['postElements' => $postElements];
    }

    public function getReturnedData()
    {
        return $this->returnedData;
    }
}