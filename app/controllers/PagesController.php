<?php

// request를 받고 -> 데이터베이스와의 동작 -> 결과 반환

class PagesController
{
    public function home()
    {

        return loadView('home');
    }

    public function information()
    {

        return loadView('information');
    }

    public function news()
    {

        return loadView('news');
    }

    public function board()
    {
        require 'dataClass/BoardPostData.php';

        $tableName = 'free_board';
        $dataClass = 'BoardPostData';
        // 페이지 하나당 계시글 갯수 선언
        $resultPerPage = 10;

        $numberOfPage = App::get('database')->paginationPageNum($tableName, $resultPerPage);
        $postList = App::get('database')->pagination($tableName, $dataClass, $resultPerPage);

        // view에게 전달할 데이터 
        $data = [
            'numberOfPage' => $numberOfPage,
            'postList' => $postList
        ];
        return loadView('board', $data);
    }

    public function boardRead()
    {
        require 'dataClass/BoardReadData.php';

        $requestPostID = $_GET['id'];

        $tableName = 'free_board';
        $dataClass = 'BoardReadData';
        $postElements = App::get('database')->fetchValueByID($tableName, $requestPostID, $dataClass);

        $addedHitCount = $postElements[0]->getHit() + 1;

        App::get('database')->updateData($tableName, $requestPostID, ['hit' =>  $addedHitCount]);

        $data = [
            'postElements' => $postElements
        ];

        return loadView('board-read', $data);
    }

    public function boardWrite()
    {

        return loadView('board-write');
    }

    public function broadcast()
    {

        return loadView('broadcast');
    }
}
