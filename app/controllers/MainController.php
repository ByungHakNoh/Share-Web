<?php

namespace app\controllers;

use core\mvc\Controller;

// request를 받고 -> 데이터베이스와의 동작 -> 결과 반환
class PagesController extends Controller
{
    public function home()
    {

        $view = $this->createView('home');
        return $view->loadView();
    }

    public function information()
    {

        $view = $this->createView('information');
        return $view->loadView();
    }

    public function news()
    {

        $view = $this->createView('news');
        return $view->loadView();
    }

    public function board()
    {
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }

        $model = $this->createModel('Board');
        $model->fetchPostData($currentPage);
        $viewData = $model->getReturnedData();

        $view = $this->createView('board', $viewData);
        return $view->loadView();
    }

    public function boardRead()
    {
        $requestPostID = $_GET['id'];

        $model = $this->createModel('BoardReadModel');
        $model->fetchBoardData($requestPostID);

        $viewData = $model->getReturnedData();
        $view = $this->createView('board-read', $viewData);
        return $view->loadView();
    }

    public function boardWrite()
    {
        $view = $this->createView('board-write');
        return $view->loadView();
    }

    public function broadcast()
    {

        $view = $this->createView('broadcast');
        return $view->loadView();
    }
}
