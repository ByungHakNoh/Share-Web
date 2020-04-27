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

            // 회원 가입 성공시 알림창이 띄워지고 확인을 누르면 로그인 페이지로 이동
            echo "<script language='javascript'>alert('회원가입 성공!! 로그인 해보세요')
            document.location.href='/login';</script>";
        } else {

            array_push($errorsArray, '비밀번호 확인을 확인해주세요');
        }
    }
}

require 'views/view_register.php';