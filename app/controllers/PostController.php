<?php

namespace app\controllers;

use core\mvc\Controller;

class PostController extends Controller
{

    public function boardWrite()
    {
        // 작성자 바꾸기
        $writer = '노병학';
        $title = $_POST['title'];
        $content = $_POST['content'];

        $model = $this->createPostModel('BoardWriteModel');
        $model->uploadScript($writer, $title, $content);
    }

    public function register()
    {
        $userID = $_POST['userID'];
        $password = $_POST['password'];
        $passwordCheck = $_POST['passwordCheck'];

        $model = $this->createPostModel('RegisterModel');
        $model->uploadUser($userID, $password, $passwordCheck);
    }
}