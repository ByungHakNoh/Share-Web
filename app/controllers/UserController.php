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
        $view = $this->createView('login');
        return $view->loadView();
    }
}