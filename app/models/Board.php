<?php

namespace app\models;

require 'app/data/BoardPostData.php';

use core\App;

class Board
{
    private $returnedData = [];

    public function fetchPostData($currentPage)
    {
        $tableName = 'free_board';
        $dataClass = 'app\data\BoardPostData';
        // 페이지 하나당 계시글 갯수 선언
        $resultPerPage = 10;

        $numberOfPage = App::get('database')->paginationPageNum($tableName, $resultPerPage);
        $postList = App::get('database')->pagination($tableName, $dataClass, $currentPage, $resultPerPage);

        $this->returnedData = [
            'numberOfPage' => $numberOfPage,
            'postList' => $postList
        ];
    }

    public function getReturnedData()
    {
        return $this->returnedData;
    }
}