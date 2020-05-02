<?php

namespace app\controllers;

use core\mvc\Controller;

// 사용자의 request를 수신받는다.

// 모델 클래스를 생성하고 필요한 데이터를 DB에서 받아온다.

// 받아온 데이터를 view에 넣고 view 객체를 생성한다.
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

        $model = $this->createModel('BoardModel');
        $model->fetchPostData($currentPage);
        $viewData = $model->getReturnedData();

        $view = $this->createView('board', $viewData);
        return $view->loadView();
    }

    public function boardRead()
    {
        $requestPostID = $_GET['id'];

        $model = $this->createModel('BoardModel');
        $model->fetchBoardData($requestPostID);

        $viewData = $model->getReturnedData();
        $view = $this->createView('board-read', $viewData);
        return $view->loadView();
    }

    public function boardWrite()
    {
        // 사용자가 게시글을 추가하는 경우
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 작성자 바꾸기
            $writer = '노병학';
            $title = $_POST['title'];
            $content = $_POST['content'];
            $directUrl = 'board';

            $model = $this->createModel('BoardModel');
            $model->uploadScript($writer, $title, $content);

            header("Location:/{$directUrl}");
            exit;

            // 글쓰기 페이지에 접속한 경우
        } else {

            $view = $this->createView('board-write');
            return $view->loadView();
        }
    }

    public function broadcast()
    {

        $view = $this->createView('broadcast');
        return $view->loadView();
    }
}