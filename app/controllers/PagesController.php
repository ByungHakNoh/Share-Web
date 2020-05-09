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
        // 처음 방문한 경우 하루 동안 쿠키 저장
        if (!isset($_COOKIE['visited'])) {
            setcookie('visited', true, time() + 86400);

            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];

            $model = $this->createModel('UserModel');
            $model->uploadAdminData($ip, $userAgent);
        }
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

        // 홈페이지의 '오늘 광고 그만보기'를 눌렀을 경우
        if (isset($_POST['notToday'])) {
            setcookie('notToday', true, time() + 86400);

            header("Location:/");
            exit;
        }
    }
}
