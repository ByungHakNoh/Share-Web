<?php

// 만약 사용자가 회원가입 버튼을 눌러 실행된다면, 회원가입 여부를 결정
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // POST 안 아이디 변수 명 바꾸기
    $userID = $_POST['userID'];
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    $errorsArray = array();

    if (
        empty($userID)
        || empty($password)
        || empty($passwordCheck)
    ) {

        if (empty($userID)) {

            array_push($errorsArray, '아이디를 입력해주세요');
        }
        if (empty($password)) {

            array_push($errorsArray, '비밀번호를 입력해주세요');
        }
        if (empty($passwordCheck)) {

            array_push($errorsArray, '비밀번호 확인을 입력해주세요');
        }
    } else {

        if ($password === $passwordCheck) {

            $result = $app['database']->insertData('practice', [
                'user_id' => '"' . $userID . '"',
                'password' => '"' . $password . '"'
            ]);

            header('Location: /login?register=성공');
        } else {

            array_push($errorsArray, '비밀번호 확인을 확인해주세요');
        }
    }
}

require 'views/view_register.php';