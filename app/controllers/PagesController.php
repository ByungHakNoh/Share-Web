<?php

namespace app\controllers;

use core\mvc\Controller;
use core\router\RequestURI;

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

    public function broadcast()
    {
        $view = $this->createView('broadcast');
        return $view->loadView();
    }

    public function cookieHandler()
    {

        if (isset($_POST['notToday'])) {
            setcookie('notToday', true, time() + 86400);
        }
        header("Location:/");
        exit;
    }
}