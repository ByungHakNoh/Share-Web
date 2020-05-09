<?php

namespace app\controllers;

use core\mvc\Controller;

class UserController extends Controller
{

    public function register()
    {
        $model = $this->createModel('UserModel');

        // 회원가입 버튼을 누른 경우 POST로 들어와 데이터베이스에 입력한 정보를 저장.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = $_POST['userID'];
            $password = $_POST['password'];
            $nickName = $_POST['nickName'];
            $sex = $_POST['sex'];
            $directUrl = 'login';

            $model->uploadUser($userID, $password, $nickName, $sex);

            header("Location:/{$directUrl}");
            exit;

            // 회원가입 페이지에 접속한 경우 GET 메소드로 들어와 뷰를 보여준다.
        } else {

            $model->fetchAllUser();
            $viewData = $model->getReturnedData();
            $view = $this->createView('register', $viewData);
            return $view->loadView();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = $_POST['userID'];
            $password = $_POST['password'];

            $model = $this->createModel('UserModel');
            $userInfo = $model->checkLoginInput($userID, $password);

            // 입력한 회원정보가 db에 존재하지 않다면 error 메세지가 뜬 채로 로그인 view 보여주기
            if ($userInfo == null) {
                $viewData = $model->getReturnedData();
                $view = $this->createView('login',  $viewData);
                return $view->loadView();

                // 입력한 회원정보가 존재한다면 session start
            } else {
                $model->startSession($userInfo);
                header('Location:/');
                exit;
            }
        } else {
            $view = $this->createView('login');
            return $view->loadView();
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location:/');
        exit;
    }

    public function adminPage()
    {
        $model = $this->createModel('UserModel');
        $model->fetchAdminData();

        $viewData = $model->getReturnedData();
        $view = $this->createView('admin', $viewData);
        return $view->loadView();
    }
}
